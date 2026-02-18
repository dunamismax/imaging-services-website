import { useState } from "react";

import { type ContactSalesInput, contactSalesSchema } from "../../lib/forms";
import { Button } from "../ui/button";

type Errors = Partial<Record<keyof ContactSalesInput | "form", string>>;

const successMessage =
  "We received your message and a member of our sales team will reach out within one business day.";

export function ContactSalesForm(): React.JSX.Element {
  const [form, setForm] = useState<ContactSalesInput>({
    name: "",
    phone: "",
    email: "",
    company: "",
    notes: "",
  });
  const [errors, setErrors] = useState<Errors>({});
  const [submitted, setSubmitted] = useState(false);
  const [isSubmitting, setIsSubmitting] = useState(false);

  async function handleSubmit(
    event: React.FormEvent<HTMLFormElement>,
  ): Promise<void> {
    event.preventDefault();
    setSubmitted(false);
    setErrors({});

    const parsed = contactSalesSchema.safeParse(form);

    if (!parsed.success) {
      const nextErrors: Errors = {};
      for (const issue of parsed.error.issues) {
        const key = issue.path[0] as keyof ContactSalesInput;
        if (!nextErrors[key]) {
          nextErrors[key] = issue.message;
        }
      }
      setErrors(nextErrors);
      return;
    }

    setIsSubmitting(true);

    try {
      const response = await fetch("/api/forms/contact-sales", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(parsed.data),
      });

      const payload = (await response.json()) as { message?: string };

      if (!response.ok) {
        setErrors({
          form:
            payload.message ??
            "Please wait and try again. If this keeps happening, call us directly.",
        });
        return;
      }

      setForm({ name: "", phone: "", email: "", company: "", notes: "" });
      setSubmitted(true);
    } catch {
      setErrors({
        form: "Network error. Please call us directly and we will help immediately.",
      });
    } finally {
      setIsSubmitting(false);
    }
  }

  return (
    <div className="surface-card p-6">
      <div className="mb-6 flex items-center justify-between gap-3">
        <div>
          <p className="brand-pill">Contact Sales</p>
          <h3 className="mt-2 card-title text-brand-deep">
            Request more information
          </h3>
        </div>
      </div>

      {submitted ? (
        <div className="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
          {successMessage}
        </div>
      ) : null}

      {errors.form ? (
        <div className="mb-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
          {errors.form}
        </div>
      ) : null}

      <form className="space-y-4" onSubmit={handleSubmit} noValidate>
        <div>
          <label htmlFor="sales-name" className="form-label">
            Your Name
          </label>
          <input
            id="sales-name"
            type="text"
            className="form-field"
            maxLength={60}
            value={form.name}
            onChange={(event) => setForm({ ...form, name: event.target.value })}
          />
          {errors.name ? (
            <p className="mt-1 text-sm text-red-600">{errors.name}</p>
          ) : null}
        </div>

        <div className="grid gap-4 sm:grid-cols-2">
          <div>
            <label htmlFor="sales-phone" className="form-label">
              Your Phone Number
            </label>
            <input
              id="sales-phone"
              type="text"
              className="form-field"
              maxLength={18}
              placeholder="(000) 000-0000"
              value={form.phone}
              onChange={(event) =>
                setForm({ ...form, phone: event.target.value })
              }
            />
            {errors.phone ? (
              <p className="mt-1 text-sm text-red-600">{errors.phone}</p>
            ) : null}
          </div>
          <div>
            <label htmlFor="sales-email" className="form-label">
              Your Best Email
            </label>
            <input
              id="sales-email"
              type="email"
              className="form-field"
              maxLength={255}
              value={form.email}
              onChange={(event) =>
                setForm({ ...form, email: event.target.value })
              }
            />
            {errors.email ? (
              <p className="mt-1 text-sm text-red-600">{errors.email}</p>
            ) : null}
          </div>
        </div>

        <div>
          <label htmlFor="sales-company" className="form-label">
            Your Company (Optional)
          </label>
          <input
            id="sales-company"
            type="text"
            className="form-field"
            maxLength={60}
            value={form.company ?? ""}
            onChange={(event) =>
              setForm({ ...form, company: event.target.value })
            }
          />
          {errors.company ? (
            <p className="mt-1 text-sm text-red-600">{errors.company}</p>
          ) : null}
        </div>

        <div>
          <label htmlFor="sales-notes" className="form-label">
            Anything Else of Note?
          </label>
          <textarea
            id="sales-notes"
            className="form-field min-h-28"
            maxLength={1000}
            value={form.notes ?? ""}
            onChange={(event) =>
              setForm({ ...form, notes: event.target.value })
            }
          />
          {errors.notes ? (
            <p className="mt-1 text-sm text-red-600">{errors.notes}</p>
          ) : null}
        </div>

        <Button type="submit" size="wide" disabled={isSubmitting}>
          {isSubmitting ? "Sending..." : "Contact Sales"}
        </Button>
      </form>
    </div>
  );
}
