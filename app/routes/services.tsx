import { Link } from "react-router";

import { SelectableRequestForm } from "../components/site/selectable-request-form";
import { asText, getServices, toArray, toRecord } from "../lib/site-content";

export default function ServicesRoute(): React.JSX.Element {
  const services = toRecord(getServices());
  const serviceOptions = toArray(services.service_options).map((option) =>
    asText(option),
  );
  const trainingOptions = toArray(services.training_options).map((option) =>
    asText(option),
  );

  return (
    <>
      <section className="page-shell page-shell-wide page-section">
        <div className="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
          <div className="lg:col-span-8">
            <p className="brand-pill">Services and Training</p>
            <h1 className="mt-4 page-title text-brand-deep">
              Call. We&apos;ll be there in an instant.
            </h1>
            <p className="mt-4 max-w-3xl page-lead">{asText(services.intro)}</p>
          </div>
          <div className="lg:col-span-4">
            <div className="rounded-2xl border border-brand-ink/10 bg-site-panel p-5">
              <p className="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">
                Fast support path
              </p>
              <p className="mt-2 text-sm text-brand-muted">
                Choose service or training options below and our team follows up
                within one business day.
              </p>
              <Link to="/contact-us" className="btn-secondary mt-5 w-full">
                Contact support team
              </Link>
            </div>
          </div>
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section-tight">
        <div className="grid gap-6 lg:grid-cols-2">
          <article className="surface-card p-6 md:p-8">
            <h2 className="card-title text-brand-deep">Service Options</h2>
            <ul className="mt-4 space-y-2">
              {serviceOptions.map((option) => (
                <li
                  className="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3 text-sm text-brand-muted"
                  key={option}
                >
                  <span className="text-brand-accent">•</span> {option}
                </li>
              ))}
            </ul>
          </article>

          <article className="surface-card p-6 md:p-8">
            <h2 className="card-title text-brand-deep">Training Focus Areas</h2>
            <ul className="mt-4 space-y-2">
              {trainingOptions.map((option) => (
                <li
                  className="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3 text-sm text-brand-muted"
                  key={option}
                >
                  <span className="text-brand-accent">•</span> {option}
                </li>
              ))}
            </ul>
            <p className="mt-5 text-sm text-brand-muted">
              {asText(services.parts_summary)}
            </p>
            <div className="mt-4 flex flex-wrap gap-2">
              {toArray(services.brands).map((brand) => (
                <span
                  className="rounded-full bg-brand-soft px-3 py-1 text-xs font-semibold uppercase tracking-wide text-brand-accent"
                  key={asText(brand)}
                >
                  {asText(brand)}
                </span>
              ))}
            </div>
          </article>
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section">
        <div className="mb-5">
          <p className="brand-pill">Request Service or Training</p>
          <h2 className="mt-3 section-title text-brand-deep">
            Send your request to our team
          </h2>
        </div>
        <div className="grid gap-6 xl:grid-cols-2">
          <SelectableRequestForm
            options={serviceOptions}
            formKey="service-request"
            optionsLegend="Select one or more options"
            buttonLabel="Request Service"
            pillLabel="Service Request"
            headingLabel="Request our service"
            successMessage="We received your message and a member of our services team will reach out within one business day."
          />

          <SelectableRequestForm
            options={trainingOptions}
            formKey="training-request"
            optionsLegend="Select one or more training options"
            buttonLabel="Request Training"
            pillLabel="Training Request"
            headingLabel="Request training"
            successMessage="We received your message and a member of our training team will reach out within one business day."
          />
        </div>
      </section>
    </>
  );
}
