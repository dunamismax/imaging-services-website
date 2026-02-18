import { asText, toArray, toRecord } from "../../lib/site-content";

type PartnersGridProps = {
  partners: unknown;
  title?: string;
};

export function PartnersGrid({
  partners,
  title = "Partners We Work With",
}: PartnersGridProps): React.JSX.Element {
  return (
    <div className="surface-card p-6 md:p-8">
      <div className="flex flex-wrap items-end justify-between gap-3">
        <p className="brand-pill">{title}</p>
        <p className="text-xs uppercase tracking-[0.12em] text-brand-muted">
          Manufacturers and Integration Partners
        </p>
      </div>
      <div className="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
        {toArray(partners).map((partner) => {
          const item = toRecord(partner);

          return (
            <div
              className="flex items-center justify-center rounded-xl border border-brand-ink/10 bg-site-panel p-3 transition duration-200 hover:-translate-y-0.5 hover:border-brand-ink/20"
              key={asText(item.name)}
            >
              <img
                src={asText(item.logo)}
                alt={asText(item.name)}
                className="h-10 w-auto object-contain"
                loading="lazy"
              />
            </div>
          );
        })}
      </div>
    </div>
  );
}
