import { ContactSalesForm } from "../components/site/contact-sales-form";
import { SelectableRequestForm } from "../components/site/selectable-request-form";
import {
  asText,
  getContact,
  getServices,
  getSiteData,
  toArray,
  toRecord,
} from "../lib/site-content";

function toDial(phone: string): string {
  return `tel:${phone.replace(/[^\d+]/g, "")}`;
}

export default function ContactRoute(): React.JSX.Element {
  const contact = toRecord(getContact());
  const site = toRecord(getSiteData());
  const company = toRecord(site.company);
  const hours = toArray(site.hours);
  const supportContacts = toArray(contact.support_contacts);
  const locations = toRecord(contact.locations);
  const principals = toArray(contact.principals);
  const services = toRecord(getServices());
  const serviceOptions = toArray(services.service_options).map((option) =>
    asText(option),
  );
  const trainingOptions = toArray(services.training_options).map((option) =>
    asText(option),
  );
  const emailSales =
    asText(company.email_sales) || asText(company.email_orders);

  return (
    <>
      <section className="page-shell page-shell-wide page-section">
        <div className="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
          <div className="lg:col-span-8">
            <p className="brand-pill">Contact Us</p>
            <h1 className="mt-4 page-title text-brand-deep">
              {asText(contact.headline)}
            </h1>
            <p className="mt-4 max-w-3xl page-lead">
              {asText(contact.subhead)}
            </p>
          </div>
          <div className="lg:col-span-4">
            <div className="rounded-2xl border border-brand-ink/10 bg-site-panel p-5">
              <p className="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">
                Quick actions
              </p>
              <a
                href={toDial(asText(company.phone_toll_free))}
                className="btn-primary mt-4 w-full"
              >
                Call {asText(company.phone_toll_free)}
              </a>
              <a
                href={`mailto:${emailSales}`}
                className="btn-secondary mt-3 w-full"
              >
                Email sales
              </a>
            </div>
          </div>
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section-tight">
        <div className="grid gap-6 lg:grid-cols-3">
          <article className="surface-card p-6 lg:col-span-2">
            <h2 className="card-title text-brand-deep">Branch Locations</h2>
            <div className="mt-4 grid gap-3 sm:grid-cols-2">
              {Object.entries(locations).map(([state, address]) => (
                <div
                  className="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3"
                  key={state}
                >
                  <p className="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">
                    {state}
                  </p>
                  <p className="mt-1 text-sm text-brand-muted">
                    {asText(address)}
                  </p>
                </div>
              ))}
            </div>

            <h3 className="mt-6 card-title text-brand-deep">
              Speak to Principals Directly
            </h3>
            <div className="mt-3 flex flex-wrap gap-3">
              {principals.map((person) => {
                const item = toRecord(person);
                const phone = asText(item.phone);

                return (
                  <a
                    href={toDial(phone)}
                    className="btn-secondary"
                    key={asText(item.name)}
                  >
                    {asText(item.name)}: {phone}
                  </a>
                );
              })}
            </div>

            <h3 className="mt-6 card-title text-brand-deep">Contact Team</h3>
            <div className="mt-3 grid gap-3 sm:grid-cols-2">
              {supportContacts.map((person) => {
                const item = toRecord(person);
                const phone = asText(item.phone);

                return (
                  <article
                    className="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3"
                    key={asText(item.email)}
                  >
                    <p className="text-sm font-semibold text-brand-deep">
                      {asText(item.name)}
                    </p>
                    <p className="text-xs uppercase tracking-[0.12em] text-brand-accent">
                      {asText(item.role)}
                    </p>
                    <a
                      href={`mailto:${asText(item.email)}`}
                      className="mt-2 block text-sm text-brand-muted hover:text-brand-deep"
                    >
                      {asText(item.email)}
                    </a>
                    {phone ? (
                      <a
                        href={toDial(phone)}
                        className="mt-1 block text-sm text-brand-muted hover:text-brand-deep"
                      >
                        {phone}
                      </a>
                    ) : null}
                  </article>
                );
              })}
            </div>

            <div className="mt-5 rounded-xl border border-brand-ink/10 bg-brand-soft p-4 text-sm text-brand-muted">
              <p>Toll Free: {asText(company.phone_toll_free)}</p>
              <p className="mt-1">
                Email Orders: {asText(company.email_orders)}
              </p>
              <p className="mt-1">Working Hours: Mon-Fri 8:30 am - 5 pm</p>
            </div>
          </article>

          <div className="surface-card p-6 lg:sticky lg:top-28 lg:h-fit">
            <h2 className="card-title text-brand-deep">Working Hours</h2>
            <dl className="mt-4 space-y-2 text-sm">
              {hours.map((slot) => {
                const item = toRecord(slot);
                return (
                  <div
                    className="flex items-center justify-between border-b border-brand-ink/10 pb-2"
                    key={asText(item.day)}
                  >
                    <dt className="font-semibold uppercase tracking-wide text-brand-muted">
                      {asText(item.day)}
                    </dt>
                    <dd className="text-brand-deep">{asText(item.hours)}</dd>
                  </div>
                );
              })}
            </dl>
          </div>
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section">
        <div className="mb-5">
          <p className="brand-pill">Request a Callback</p>
          <h2 className="mt-3 section-title text-brand-deep">
            Tell us what you need
          </h2>
        </div>
        <div className="grid gap-6 xl:grid-cols-2">
          <ContactSalesForm />

          <SelectableRequestForm
            options={serviceOptions}
            formKey="service-request"
            optionsLegend="Select one or more options"
            buttonLabel="Request Service"
            pillLabel="Service Request"
            headingLabel="Request our service"
            successMessage="We received your message and a member of our services team will reach out within one business day."
          />
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section-tight">
        <SelectableRequestForm
          options={trainingOptions}
          formKey="training-request"
          optionsLegend="Select one or more training options"
          buttonLabel="Request Training"
          pillLabel="Training Request"
          headingLabel="Request training"
          successMessage="We received your message and a member of our training team will reach out within one business day."
        />
      </section>
    </>
  );
}
