import { z } from "zod";

const envSchema = z.object({
  DATABASE_URL: z.url(),
  SERVER_PORT: z.coerce.number().int().min(1).max(65535).default(3001),
});

export const env = envSchema.parse(process.env);
