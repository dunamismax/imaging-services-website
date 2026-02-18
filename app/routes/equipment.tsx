import { Link } from "react-router";

import { PartnersGrid } from "../components/site/partners-grid";
import {
  asText,
  getEquipment,
  getSiteData,
  toArray,
  toRecord,
} from "../lib/site-content";

export default function EquipmentRoute(): React.JSX.Element {
  const equipment = toRecord(getEquipment());
  const site = toRecord(getSiteData());
  const partners = toArray(site.partners);

  return (
    <>
      <section className="page-shell page-shell-wide page-section">
        <div className="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
          <div className="lg:col-span-8">
            <p className="brand-pill">Equipment</p>
            <h1 className="mt-4 page-title text-brand-deep">
              Imaging systems for chiropractic, podiatry, veterinary, mobile,
              and orthopedic workflows
            </h1>
            <div className="mt-5 grid gap-3">
              {toArray(equipment.intro).map((line) => (
                <p className="page-body" key={asText(line)}>
                  {asText(line)}
                </p>
              ))}
            </div>
          </div>
          <aside className="lg:col-span-4">
            <div className="rounded-2xl border border-brand-ink/10 bg-site-panel p-5">
              <p className="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">
                Need guidance?
              </p>
              <p className="mt-2 text-sm text-brand-muted">
                Our team helps you choose the right system for your room size,
                workflow, and budget.
              </p>
              <Link to="/contact-us" className="btn-secondary mt-5 w-full">
                Talk to Equipment Sales
              </Link>
            </div>
          </aside>
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section">
        <div className="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
          {toArray(equipment.categories).map((item) => {
            const category = toRecord(item);

            return (
              <article
                className="surface-card group overflow-hidden"
                key={asText(category.slug)}
              >
                <img
                  src={asText(category.image)}
                  alt={asText(category.name)}
                  className="h-52 w-full object-cover"
                />
                <div className="bg-site-panel p-5">
                  <h2 className="card-title text-brand-deep">
                    {asText(category.name)}
                  </h2>
                  <Link
                    to={asText(category.url)}
                    className="mt-3 inline-flex text-sm font-semibold text-brand-accent transition group-hover:translate-x-0.5 hover:text-brand-deep"
                  >
                    View product page
                  </Link>
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
