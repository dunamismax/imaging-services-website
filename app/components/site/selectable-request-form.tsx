import { useMemo, useState } from "react";

import {
  type SelectableRequestInput,
  selectableRequestSchema,
} from "../../lib/forms";
import { Button } from "../ui/button";

type SelectableRequestFormProps = {
  options: string[];
  formKey: "service-request" | "training-request";
  optionsLegend: string;
  buttonLabel: string;
  pillLabel: string;
  headingLabel: string;
  successMessage: string;
  requireCompany?: boolean;
};

type Errors = Partial<Record<keyof SelectableRequestInput | "form", string>>;

export function SelectableRequestForm({
  options,
  formKey,
  optionsLegend,
  buttonLabel,
  pillLabel,
  headingLabel,
  successMessage,
  requireCompany = true,
}: SelectableRequestFormProps): React.JSX.Element {
  const [form, setForm] = useState<SelectableRequestInput>({
    name: "",
    phone: "",
    email: "",
    company: "",
    notes: "",
    formKey,
    selectedOptions: [],
    options,
    requireCompany,
  });
  const [errors, setErrors] = useState<Errors>({});
  const [submitted, setSubmitted] = useState(false);
  const [isSubmitting, setIsSubmitting] = useState(false);

  const idPrefix = useMemo(() => formKey.toLowerCase(), [formKey]);

  async function handleSubmit(
    event: React.FormEvent<HTMLFormElement>,
  ): Promise<void> {
    event.preventDefault();
    setSubmitted(false);
    setErrors({});

    const parsed = selectableRequestSchema.safeParse({
      ...form,
      options,
      formKey,
      requireCompany,
    });

    if (!parsed.success) {
      const nextErrors: Errors = {};
      for (const issue of parsed.error.issues) {
        const key = issue.path[0] as keyof SelectableRequestInput;
        if (!nextErrors[key]) {
          nextErrors[key] = issue.message;
        }
      }
      setErrors(nextErrors);
      return;
    }

    setIsSubmitting(true);

    try {
      const response = await fetch("/api/forms/selectable-request", {
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

      setForm({
        ...form,
        name: "",
        phone: "",
        email: "",
        company: "",
        notes: "",
        selectedOptions: [],
      });
      setSubmitted(true);
    } catch {
      setErrors({
        form: "Network error. Please call us directly and we will help immediately.",
      });
    } finally {
      setIsSubmitting(false);
    }
  }

  function toggleOption(option: string, checked: boolean): void {
    if (checked) {
      setForm({ ...form, selectedOptions: [...form.selectedOptions, option] });
      return;
    }

    setForm({
      ...form,
      selectedOptions: form.selectedOptions.filter((value) => value !== option),
    });
  }

  return (
    <div className="surface-card p-6">
      <p className="brand-pill">{pillLabel}</p>
      <h3 className="mt-2 card-title text-brand-deep">{headingLabel}</h3>

      {submitted ? (
        <div className="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
          {successMessage}
        </div>
      ) : null}

      {errors.form ? (
        <div className="mt-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
          {errors.form}
        </div>
      ) : null}

      <form className="mt-5 space-y-4" onSubmit={handleSubmit} noValidate>
        <div className="grid gap-4 sm:grid-cols-2">
          <div>
            <label htmlFor={`${idPrefix}-name`} className="form-label">
              Your Name
            </label>
            <input
              id={`${idPrefix}-name`}
              type="text"
              className="form-field"
              maxLength={60}
              value={form.name}
              onChange={(event) =>
                setForm({ ...form, name: event.target.value })
              }
            />
            {errors.name ? (
              <p className="mt-1 text-sm text-red-600">{errors.name}</p>
            ) : null}
          </div>
          <div>
            <label htmlFor={`${idPrefix}-company`} className="form-label">
              {`Your Company${requireCompany ? "" : " (Optional)"}`}
            </label>
            <input
              id={`${idPrefix}-company`}
              type="text"
              className="form-field"
              maxLength={60}
              value={form.company}
              onChange={(event) =>
                setForm({ ...form, company: event.target.value })
              }
            />
            {errors.company ? (
              <p className="mt-1 text-sm text-red-600">{errors.company}</p>
            ) : null}
          </div>
        </div>

        <div className="grid gap-4 sm:grid-cols-2">
          <div>
            <label htmlFor={`${idPrefix}-phone`} className="form-label">
              Your Phone Number
            </label>
            <input
              id={`${idPrefix}-phone`}
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
            <label htmlFor={`${idPrefix}-email`} className="form-label">
              Your Best Email
            </label>
            <input
              id={`${idPrefix}-email`}
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

        <fieldset>
          <legend className="form-label">{optionsLegend}</legend>
          <div className="grid gap-2 sm:grid-cols-2">
            {options.map((option) => (
              <label
                className="flex items-start gap-2 rounded-xl border border-brand-ink/10 bg-site-panel px-3 py-2 text-sm text-brand-muted transition hover:border-brand-ink/20"
                key={option}
              >
                <input
                  type="checkbox"
                  value={option}
                  className="mt-0.5 size-4 rounded border-brand-ink/20 text-brand-accent"
                  checked={form.selectedOptions.includes(option)}
                  onChange={(event) =>
                    toggleOption(option, event.target.checked)
                  }
                />
                <span>{option}</span>
              </label>
            ))}
          </div>
          {errors.selectedOptions ? (
            <p className="mt-1 text-sm text-red-600">
              {errors.selectedOptions}
            </p>
          ) : null}
        </fieldset>

        <div>
          <label htmlFor={`${idPrefix}-notes`} className="form-label">
            Anything Else?
          </label>
          <textarea
            id={`${idPrefix}-notes`}
            className="form-field min-h-24"
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
          {isSubmitting ? "Sending..." : buttonLabel}
        </Button>
      </form>
    </div>
  );
}
