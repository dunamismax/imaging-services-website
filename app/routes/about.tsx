import { Link } from "react-router";

import { PartnersGrid } from "../components/site/partners-grid";
import {
  asText,
  getAbout,
  getSiteData,
  toArray,
  toRecord,
} from "../lib/site-content";

export default function AboutRoute(): React.JSX.Element {
  const about = toRecord(getAbout());
  const site = toRecord(getSiteData());
  const company = toRecord(site.company);
  const partners = toArray(site.partners);
  const team = toArray(about.team);
  const statesServed = toArray(company.states_served);

  return (
    <>
      <section className="page-shell page-shell-wide page-section">
        <div className="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
          <div className="lg:col-span-8">
            <p className="brand-pill">About Imaging Services</p>
            <h1 className="mt-4 page-title text-brand-deep">
              Our dedicated team caters to your business
            </h1>
            <p className="mt-4 max-w-3xl page-lead">{asText(about.intro)}</p>
            <p className="mt-2 max-w-3xl page-body">
              {asText(about.supporting)}
            </p>
            <div className="mt-6 flex flex-wrap gap-3">
              <Link to="/contact-us" className="btn-primary">
                Talk to the team
              </Link>
              <Link to="/services" className="btn-secondary">
                Explore services
              </Link>
            </div>
          </div>
          <aside className="lg:col-span-4">
            <div className="grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
              <article className="rounded-2xl border border-brand-ink/10 bg-site-panel p-4">
                <p className="text-xs uppercase tracking-[0.12em] text-brand-muted">
                  Team Members
                </p>
                <p className="mt-1 section-title text-brand-deep">
                  {team.length}
                </p>
              </article>
              <article className="rounded-2xl border border-brand-ink/10 bg-site-panel p-4">
                <p className="text-xs uppercase tracking-[0.12em] text-brand-muted">
                  States Served
                </p>
                <p className="mt-1 section-title text-brand-deep">
                  {statesServed.length}
                </p>
              </article>
            </div>
          </aside>
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section">
        <div className="mb-5 flex flex-wrap items-end justify-between gap-3">
          <p className="brand-pill">Our Team</p>
          <h2 className="section-title text-brand-deep">
            People behind your imaging operations
          </h2>
        </div>

        <div className="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
          {team.map((member) => {
            const item = toRecord(member);

            return (
              <article
                className="surface-card group overflow-hidden"
                key={asText(item.name)}
              >
                <img
                  src={asText(item.image)}
                  alt={asText(item.name)}
                  className="h-64 w-full object-cover"
                />
                <div className="bg-site-panel p-4">
                  <h3 className="card-title text-brand-deep">
                    {asText(item.name)}
                  </h3>
                  <p className="mt-1 text-sm uppercase tracking-[0.14em] text-brand-accent">
                    {asText(item.role)}
                  </p>
                  <p className="mt-3 text-xs uppercase tracking-[0.12em] text-brand-muted">
                    Imaging Services Team
                  </p>
                </div>
              </article>
            );
          })}
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section-loose pb-4">
        <PartnersGrid partners={partners} title="Partners" />
      </section>
    </>
  );
}
