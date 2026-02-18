import { Link } from "react-router";

import { PartnersGrid } from "../components/site/partners-grid";
import {
  asText,
  getAccessories,
  getSiteData,
  toArray,
  toRecord,
} from "../lib/site-content";

export default function AccessoriesRoute(): React.JSX.Element {
  const accessories = toRecord(getAccessories());
  const site = toRecord(getSiteData());
  const partners = toArray(site.partners);

  return (
    <>
      <section className="page-shell page-shell-wide page-section">
        <div className="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
          <div className="lg:col-span-8">
            <p className="brand-pill">Accessories</p>
            <h1 className="mt-4 page-title text-brand-deep">
              View and select from our accessories catalog
            </h1>
            <p className="mt-4 max-w-3xl page-lead">
              {asText(accessories.summary)}
            </p>
          </div>
          <div className="lg:col-span-4">
            <div className="rounded-2xl border border-brand-ink/10 bg-site-panel p-5">
              <p className="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">
                Ordering support
              </p>
              <p className="mt-2 text-sm text-brand-muted">
                Need help finding part numbers or lead times? We can help you
                place the right order quickly.
              </p>
              <Link to="/contact-us" className="btn-secondary mt-5 w-full">
                Request assistance
              </Link>
            </div>
          </div>
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section-tight">
        <div className="grid gap-6 lg:grid-cols-2">
          <article className="surface-card p-6 md:p-8">
            <h2 className="card-title text-brand-deep">Ordering Process</h2>
            <ul className="mt-4 space-y-3">
              {toArray(accessories.notes).map((note, index) => (
                <li
                  className="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3 text-sm text-brand-muted"
                  key={asText(note)}
                >
                  <span className="mr-2 font-semibold text-brand-accent">
                    {index + 1}.
                  </span>
                  {asText(note)}
                </li>
              ))}
            </ul>

            <div className="mt-6 flex flex-wrap gap-3">
              <a
                href={asText(accessories.catalog_pdf)}
                target="_blank"
                rel="noreferrer"
                className="btn-primary"
              >
                Download Accessories Catalog
              </a>
              <Link to="/payments" className="btn-secondary">
                Go to Payments
              </Link>
            </div>
          </article>

          <div className="surface-card relative overflow-hidden">
            <img
              src={asText(accessories.catalog_image)}
              alt="Accessories catalog preview"
              className="h-full min-h-80 w-full object-cover"
            />
            <div className="absolute inset-x-0 bottom-0 bg-linear-to-t from-black/60 to-transparent p-5">
              <p className="text-xs uppercase tracking-[0.14em] text-white/80">
                Preview
              </p>
              <p className="mt-1 text-lg text-white">Accessories Catalog</p>
            </div>
          </div>
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section-loose pb-4">
        <PartnersGrid partners={partners} />
      </section>
    </>
  );
}
