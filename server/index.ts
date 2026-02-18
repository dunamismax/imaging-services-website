import { desc } from "drizzle-orm";
import { contactSalesSchema, selectableRequestSchema } from "../app/lib/forms";
import { db } from "./db/client";
import { formSubmissions } from "./db/schema";
import { env } from "./env";

type RateLimitState = {
  count: number;
  firstRequestAt: number;
};

const rateLimits = new Map<string, RateLimitState>();
const RATE_LIMIT_MAX = 5;
const RATE_LIMIT_WINDOW_MS = 120_000;

function getIp(request: Request): string {
  const forwardedFor = request.headers.get("x-forwarded-for");
  if (forwardedFor) {
    return forwardedFor.split(",")[0].trim();
  }

  return "unknown";
}

function isRateLimited(key: string): {
  blocked: boolean;
  retryAfterSeconds: number;
} {
  const now = Date.now();
  const entry = rateLimits.get(key);

  if (!entry) {
    rateLimits.set(key, { count: 1, firstRequestAt: now });
    return { blocked: false, retryAfterSeconds: 0 };
  }

  if (now - entry.firstRequestAt > RATE_LIMIT_WINDOW_MS) {
    rateLimits.set(key, { count: 1, firstRequestAt: now });
    return { blocked: false, retryAfterSeconds: 0 };
  }

  if (entry.count >= RATE_LIMIT_MAX) {
    const retryAfterSeconds = Math.max(
      1,
      Math.ceil((RATE_LIMIT_WINDOW_MS - (now - entry.firstRequestAt)) / 1000),
    );

    return { blocked: true, retryAfterSeconds };
  }

  entry.count += 1;
  rateLimits.set(key, entry);

  return { blocked: false, retryAfterSeconds: 0 };
}

function json(data: unknown, status = 200): Response {
  return new Response(JSON.stringify(data), {
    status,
    headers: {
      "Content-Type": "application/json",
    },
  });
}

const server = Bun.serve({
  port: env.SERVER_PORT,
  async fetch(request): Promise<Response> {
    const url = new URL(request.url);

    if (request.method === "GET" && url.pathname === "/api/health") {
      const latest = await db
        .select()
        .from(formSubmissions)
        .orderBy(desc(formSubmissions.createdAt))
        .limit(1);
      return json({
        status: "ok",
        submissions: latest.length,
      });
    }

    if (
      request.method === "POST" &&
      url.pathname === "/api/forms/contact-sales"
    ) {
      const ip = getIp(request);
      const rateLimit = isRateLimited(`contact-sales:${ip}`);

      if (rateLimit.blocked) {
        return json(
          {
            message: `Please wait ${rateLimit.retryAfterSeconds} seconds before submitting again.`,
          },
          429,
        );
      }

      const payload = await request.json();
      const parsed = contactSalesSchema.safeParse(payload);

      if (!parsed.success) {
        return json({ message: "Invalid form data." }, 422);
      }

      await db.insert(formSubmissions).values({
        formType: "contact_sales",
        name: parsed.data.name,
        phone: parsed.data.phone,
        email: parsed.data.email,
        company: parsed.data.company || null,
        notes: parsed.data.notes || null,
        selectedOptions: null,
        ipAddress: ip,
      });

      return json({ ok: true });
    }

    if (
      request.method === "POST" &&
      url.pathname === "/api/forms/selectable-request"
    ) {
      const ip = getIp(request);
      const payload = await request.json();
      const parsed = selectableRequestSchema.safeParse(payload);

      if (!parsed.success) {
        return json({ message: "Invalid form data." }, 422);
      }

      const rateLimit = isRateLimited(`${parsed.data.formKey}:${ip}`);

      if (rateLimit.blocked) {
        return json(
          {
            message: `Please wait ${rateLimit.retryAfterSeconds} seconds before submitting again.`,
          },
          429,
        );
      }

      await db.insert(formSubmissions).values({
        formType: parsed.data.formKey.replace("-", "_"),
        name: parsed.data.name,
        phone: parsed.data.phone,
        email: parsed.data.email,
        company: parsed.data.company || null,
        notes: parsed.data.notes || null,
        selectedOptions: parsed.data.selectedOptions,
        ipAddress: ip,
      });

      return json({ ok: true });
    }

    return json({ message: "Not found" }, 404);
  },
});

console.log(`API server running at http://localhost:${server.port}`);
