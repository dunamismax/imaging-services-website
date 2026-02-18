import { Link, useParams } from "react-router";

import {
  asText,
  getEquipmentDetail,
  toArray,
  toRecord,
} from "../lib/site-content";

export default function EquipmentDetailRoute(): React.JSX.Element {
  const params = useParams();
  const equipment = getEquipmentDetail(params.equipmentSlug ?? "");

  if (!equipment) {
    throw new Response("Not Found", { status: 404 });
  }

  const item = toRecord(equipment);

  return (
    <section className="page-shell page-shell-wide page-section">
      <Link
        to="/equipment"
        className="text-sm font-semibold text-brand-accent hover:text-brand-deep"
      >
        &larr; Back to Equipment
      </Link>

      <div className="mt-4 grid gap-6 lg:grid-cols-2">
        <div className="surface-card overflow-hidden">
          <img
            src={asText(item.image)}
            alt={asText(item.title)}
            className="h-full min-h-72 w-full object-cover"
          />
        </div>

        <article className="surface-card p-6 md:p-8">
          <p className="brand-pill">Equipment Detail</p>
          <h1 className="mt-3 page-title-compact text-brand-deep">
            {asText(item.title)}
          </h1>
          <p className="mt-3 page-body">{asText(item.subtitle)}</p>

          <ul className="mt-5 space-y-2">
            {toArray(item.highlights).map((highlight) => (
              <li
                className="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3 text-sm text-brand-muted"
                key={asText(highlight)}
              >
                <span className="text-brand-accent">•</span> {asText(highlight)}
              </li>
            ))}
          </ul>

          {toArray(item.sections).length > 0 ? (
            <div className="mt-7 space-y-5">
              {toArray(item.sections).map((section) => {
                const sectionRecord = toRecord(section);

                return (
                  <section
                    className="rounded-2xl border border-brand-ink/10 bg-site-panel px-4 py-4"
                    key={asText(sectionRecord.title)}
                  >
                    <h2 className="card-title text-brand-deep">
                      {asText(sectionRecord.title)}
                    </h2>
                    {toArray(sectionRecord.paragraphs).length > 0 ? (
                      <div className="mt-3 space-y-2 text-sm leading-relaxed text-brand-muted">
                        {toArray(sectionRecord.paragraphs).map((paragraph) => (
                          <p key={asText(paragraph)}>{asText(paragraph)}</p>
                        ))}
                      </div>
                    ) : null}
                    {toArray(sectionRecord.bullets).length > 0 ? (
                      <ul className="mt-3 space-y-2">
                        {toArray(sectionRecord.bullets).map((bullet) => (
                          <li
                            className="rounded-xl border border-brand-ink/10 bg-brand-soft px-3 py-2 text-sm text-brand-muted"
                            key={asText(bullet)}
                          >
                            {asText(bullet)}
                          </li>
                        ))}
                      </ul>
                    ) : null}
                  </section>
                );
              })}
            </div>
          ) : null}

          <div className="mt-6 flex flex-wrap gap-3">
            <Link to="/contact-us" className="btn-primary">
              Request Pricing
            </Link>
            <Link to="/services" className="btn-secondary">
              See Service Options
            </Link>
            {asText(item.brochure) ? (
              <a
                href={asText(item.brochure)}
                target="_blank"
                rel="noreferrer"
                className="btn-secondary"
              >
                Download Brochure
              </a>
            ) : null}
          </div>
        </article>
      </div>
    </section>
  );
}
