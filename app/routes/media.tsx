import { Link } from "react-router";

import { asText, getMediaPosts, toRecord } from "../lib/site-content";

export default function MediaRoute(): React.JSX.Element {
  const posts = getMediaPosts();
  const orderedPosts = Object.entries(posts).map(([slug, post]) => ({
    slug,
    ...post,
  }));

  return (
    <>
      <section className="page-shell page-shell-wide page-section">
        <div className="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
          <div className="lg:col-span-9">
            <p className="brand-pill">Media</p>
            <h1 className="mt-4 page-title text-brand-deep">
              Digital imaging latest news and insights
            </h1>
            <p className="mt-4 max-w-3xl page-lead">
              Browse archived and current media content from Imaging Services.
            </p>
          </div>
          <div className="lg:col-span-3">
            <div className="rounded-2xl border border-brand-ink/10 bg-site-panel p-5">
              <p className="text-xs uppercase tracking-[0.12em] text-brand-muted">
                Published Articles
              </p>
              <p className="mt-1 section-title text-brand-deep">
                {orderedPosts.length}
              </p>
            </div>
          </div>
        </div>
      </section>

      <section className="page-shell page-shell-wide page-section pb-4">
        <div className="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
          {orderedPosts.map((post) => {
            const item = toRecord(post);

            return (
              <article
                className="surface-card group flex h-full flex-col p-5"
                key={asText(item.slug)}
              >
                <p className="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">
                  {asText(item.published)}
                </p>
                <h2 className="mt-3 card-title text-brand-deep">
                  {asText(item.title)}
                </h2>
                <p className="mt-3 grow text-sm text-brand-muted">
                  {asText(item.summary)}
                </p>
                <Link
                  to={asText(item.url)}
                  className="mt-4 inline-flex text-sm font-semibold text-brand-accent transition group-hover:translate-x-0.5 hover:text-brand-deep"
                >
                  Read article
                </Link>
              </article>
            );
          })}
        </div>
      </section>
    </>
  );
}
