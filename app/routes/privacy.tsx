import {
  asText,
  getPrivacy,
  getSiteData,
  toArray,
  toRecord,
} from "../lib/site-content";

export default function PrivacyRoute(): React.JSX.Element {
  const privacy = toRecord(getPrivacy());
  const site = toRecord(getSiteData());
  const company = toRecord(site.company);

  return (
    <section className="page-shell page-shell-medium page-section">
      <div className="surface-card p-6 md:p-8">
        <p className="brand-pill">Privacy Policy and Terms</p>
        <h1 className="mt-4 page-title text-brand-deep">
          Privacy Policy and Terms of Use
        </h1>
        <p className="mt-2 text-sm uppercase tracking-[0.12em] text-brand-accent">
          Effective Date: {asText(privacy.effective_date)}
        </p>
      </div>

      <article className="surface-card mt-6 p-6">
        <p className="page-body">{asText(privacy.summary)}</p>

        {toArray(privacy.sections).map((section) => {
          const sectionItem = toRecord(section);

          return (
            <div className="mt-6" key={asText(sectionItem.title)}>
              <h2 className="card-title text-brand-deep">
                {asText(sectionItem.title)}
              </h2>
              <ul className="mt-3 space-y-2">
                {toArray(sectionItem.body).map((line) => (
                  <li
                    className="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3 text-sm text-brand-muted"
                    key={asText(line)}
                  >
                    {asText(line)}
                  </li>
                ))}
              </ul>
            </div>
          );
        })}

        <div className="mt-6 rounded-xl border border-brand-ink/10 bg-brand-soft p-4 text-sm text-brand-muted">
          <p>
            <strong>{asText(company.legal_name)}</strong>
          </p>
          <p className="mt-1">Phone: {asText(company.phone_primary)}</p>
          <p className="mt-1">Address: {asText(company.hq_address)}</p>
        </div>
      </article>
    </section>
  );
}
