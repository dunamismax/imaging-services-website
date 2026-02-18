import { Link, useParams } from "react-router";

import {
  asText,
  getBlogPost,
  getMarketingPage,
  toArray,
  toRecord,
} from "../lib/site-content";

function BlogPostPage({ post }: { post: unknown }): React.JSX.Element {
  const item = toRecord(post);

  return (
    <section className="page-shell page-shell-narrow page-section">
      <Link
        to={asText(item.backUrl)}
        className="text-sm font-semibold text-brand-accent hover:text-brand-deep"
      >
        &larr; Back to Media
      </Link>

      <article className="surface-card mt-4 p-6 md:p-8">
        <p className="brand-pill">{asText(item.published)}</p>
        <h1 className="mt-4 page-title text-brand-deep">
          {asText(item.title)}
        </h1>
        <p className="mt-4 page-lead">{asText(item.summary)}</p>

        <div className="mt-6 space-y-4 reading-body">
          {toArray(item.content).map((paragraph) => (
            <p key={asText(paragraph)}>{asText(paragraph)}</p>
          ))}
        </div>

        {toArray(item.sections).length > 0 ? (
          <div className="mt-8 space-y-8">
            {toArray(item.sections).map((section) => {
              const sectionItem = toRecord(section);

              return (
                <section
                  className="rounded-2xl border border-brand-ink/10 bg-site-panel px-4 py-5 md:px-5"
                  key={asText(sectionItem.title)}
                >
                  <h2 className="card-title text-brand-deep">
                    {asText(sectionItem.title)}
                  </h2>
                  {toArray(sectionItem.paragraphs).length > 0 ? (
                    <div className="mt-3 space-y-3 reading-body">
                      {toArray(sectionItem.paragraphs).map((paragraph) => (
                        <p key={asText(paragraph)}>{asText(paragraph)}</p>
                      ))}
                    </div>
                  ) : null}
                  {toArray(sectionItem.bullets).length > 0 ? (
                    <ul className="mt-4 space-y-2">
                      {toArray(sectionItem.bullets).map((bullet) => (
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

        <div className="mt-8 flex flex-wrap gap-3">
          <Link to="/contact-us" className="btn-primary">
            Talk to Our Team
          </Link>
          <Link to="/equipment" className="btn-secondary">
            Explore Equipment
          </Link>
        </div>
      </article>
    </section>
  );
}

function MarketingPage({ page }: { page: unknown }): React.JSX.Element {
  const item = toRecord(page);

  return (
    <section className="page-shell page-shell-narrow page-section">
      <article className="surface-card p-6 md:p-8">
        <p className="brand-pill">Imaging Services</p>
        <h1 className="mt-4 page-title text-brand-deep">
          {asText(item.title)}
        </h1>
        <p className="mt-4 page-lead">{asText(item.description)}</p>

        <div className="mt-6 space-y-4 rounded-2xl border border-brand-ink/10 bg-site-panel p-4 reading-body">
          {toArray(item.body).map((paragraph) => (
            <p key={asText(paragraph)}>{asText(paragraph)}</p>
          ))}
        </div>

        <div className="mt-8 flex flex-wrap gap-3">
          <Link to={asText(item.ctaUrl)} className="btn-primary">
            {asText(toRecord(item.cta).label) || "Learn More"}
          </Link>
          <Link to={asText(item.homeUrl)} className="btn-secondary">
            Return Home
          </Link>
        </div>
      </article>
    </section>
  );
}

export default function SlugRoute(): React.JSX.Element {
  const params = useParams();
  const slug = params.slug ?? "";

  const blogPost = getBlogPost(slug);
  if (blogPost) {
    return <BlogPostPage post={blogPost} />;
  }

  const marketingPage = getMarketingPage(slug);
  if (marketingPage) {
    return <MarketingPage page={marketingPage} />;
  }

  throw new Response("Not Found", { status: 404 });
}
