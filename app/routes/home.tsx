import { Link } from "react-router";

import { PartnersGrid } from "../components/site/partners-grid";
import {
  asText,
  getHome,
  getSiteData,
  toArray,
  toRecord,
} from "../lib/site-content";

export default function HomeRoute(): React.JSX.Element {
  const home = toRecord(getHome());
  const site = toRecord(getSiteData());
  const company = toRecord(site.company);
  const hours = toArray(site.hours);
  const partners = toArray(site.partners);
  const statesServed = toArray(company.states_served);
  const hero = toRecord(home.hero);

  const statCards = [
    { label: "Years Supporting Clinics", value: "45+" },
    { label: "States Covered", value: String(statesServed.length) },
    { label: "Manufacturer Partners", value: String(partners.length) },
  ];

  return (
    <>
      <section className="page-shell page-shell-wide page-section grid gap-8 lg:grid-cols-12">
        <div className="lg:col-span-7">
          <p className="brand-pill">Imaging Services USA</p>
          <h1 className="mt-4 page-title text-brand-deep">
            {asText(hero.headline)}
          </h1>
          <p className="mt-4 max-w-2xl page-lead">{asText(hero.subheadline)}</p>
          <p className="mt-3 max-w-2xl page-body">{asText(hero.summary)}</p>

          <div className="mt-8 flex flex-wrap gap-3">
            <Link
              to={asText(toRecord(hero.primary_cta).url)}
              className="btn-primary"
            >
              {asText(toRecord(hero.primary_cta).label)}
            </Link>
            <Link
              to={asText(toRecord(hero.secondary_cta).url)}
              className="btn-secondary"
            >
              {asText(toRecord(hero.secondary_cta).label)}
            </Link>
          </div>

          <div className="mt-8 grid gap-3 sm:grid-cols-3">
            {statCards.map((stat) => (
              <article
                className="surface-card bg-site-panel p-4"
                key={stat.label}
              >
                <p className="card-title text-brand-deep">{stat.value}</p>
                <p className="mt-1 text-xs uppercase tracking-[0.12em] text-brand-muted">
                  {stat.label}
                </p>
              </article>
            ))}
          </div>
        </div>

        <div className="lg:col-span-5">
          <div className="surface-card overflow-hidden">
            <img
              src={asText(hero.image)}
              alt="Medical imaging equipment in a treatment room"
              className="h-64 w-full object-cover md:h-72"
            />
            <div className="bg-site-panel p-5">
              <p className="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">
                Regional Coverage
              </p>
              <p className="mt-2 text-sm text-brand-muted">
                Serving {statesServed.map((state) => asText(state)).join(", ")}{" "}
                with installation, retrofits, and responsive support.
              </p>
            </div>
          </div>

          <aside className="surface-card mt-5 p-5">
            <h2 className="card-title text-brand-deep">
              Typical Working Hours
            </h2>
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
            <p className="mt-4 text-sm text-brand-muted">
              Toll free: {asText(company.phone_toll_free)}
            </p>
            <p className="mt-1 text-sm text-brand-muted">
              Orders: {asText(company.email_orders)}
            </p>
          </aside>
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section-loose">
        <div className="surface-card p-6 md:p-8">
          <div className="mb-4 flex flex-wrap items-end justify-between gap-3">
            <div>
              <p className="brand-pill">Our Main Advantages</p>
              <h2 className="mt-3 section-title text-brand-deep">
                A practical partner for your imaging operations
              </h2>
            </div>
            <Link to="/contact-us" className="btn-secondary">
              Talk to our team
            </Link>
          </div>
          <div className="mt-4 grid gap-4 md:grid-cols-2">
            {toArray(home.advantages).map((advantage) => (
              <article
                className="rounded-2xl border border-brand-ink/10 bg-site-panel p-4"
                key={asText(advantage)}
              >
                <p className="page-body">{asText(advantage)}</p>
              </article>
            ))}
          </div>
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section-loose">
        <div className="mb-6 flex items-end justify-between gap-3">
          <div>
            <p className="brand-pill">Types of Equipment</p>
            <h2 className="mt-3 section-title text-brand-deep">
              Built for real clinical workflows
            </h2>
          </div>
          <Link to="/equipment" className="btn-secondary">
            View All
          </Link>
        </div>
        <div className="grid gap-5 md:grid-cols-2">
          {toArray(home.categories).map((category) => {
            const item = toRecord(category);

            return (
              <article
                className="surface-card overflow-hidden"
                key={asText(item.slug)}
              >
                <img
                  src={asText(item.image)}
                  alt={asText(item.title)}
                  className="h-56 w-full object-cover"
                />
                <div className="p-5">
                  <p className="text-sm font-semibold uppercase tracking-[0.14em] text-brand-accent">
                    {asText(item.subtitle)}
                  </p>
                  <h3 className="mt-2 card-title text-brand-deep">
                    {asText(item.title)}
                  </h3>
                  <Link
                    to={asText(item.url)}
                    className="mt-4 inline-flex text-sm font-semibold text-brand-accent hover:text-brand-deep"
                  >
                    View details
                  </Link>
                </div>
              </article>
            );
          })}
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section-loose">
        <div className="mb-6">
          <p className="brand-pill">Word on the Street</p>
          <h2 className="mt-3 section-title text-brand-deep">
            Customer feedback from the field
          </h2>
        </div>
        <div className="grid gap-5 lg:grid-cols-3">
          {toArray(home.testimonials).map((testimonial) => {
            const item = toRecord(testimonial);

            return (
              <article className="surface-card p-5" key={asText(item.quote)}>
                <p className="text-sm text-brand-muted">
                  &quot;{asText(item.quote)}&quot;
                </p>
                <div className="mt-5 flex items-center gap-3">
                  <img
                    src={asText(item.image)}
                    alt={asText(item.author)}
                    className="size-12 rounded-full object-cover"
                  />
                  <div>
                    <p className="text-sm font-semibold text-brand-deep">
                      {asText(item.author)}
                    </p>
                    <p className="text-xs text-brand-muted">
                      {asText(item.location)}
                    </p>
                  </div>
                </div>
              </article>
            );
          })}
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section-loose pb-4">
        <PartnersGrid partners={partners} />
      </section>
    </>
  );
}
