import {
  isRouteErrorResponse,
  Link,
  NavLink,
  Outlet,
  Scripts,
  ScrollRestoration,
  useRouteError,
} from "react-router";

import { asText, getSiteData, toArray, toRecord } from "./lib/site-content";
import "./styles.css";

export default function App(): React.JSX.Element {
  const site = toRecord(getSiteData());
  const company = toRecord(site.company);
  const navigation = toArray(site.navigation);
  const quickLinks = toArray(site.quickLinks);
  const urls = toRecord(site.urls);

  return (
    <html lang="en">
      <head>
        <meta charSet="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" sizes="any" />
        <link rel="icon" href="/favicon.svg" type="image/svg+xml" />
        <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
        <title>Imaging Services</title>
      </head>
      <body className="site-body antialiased">
        <div className="site-grid-bg" />
        <div className="min-h-screen">
          <header className="site-header sticky top-0 z-40 border-b border-brand-ink/10 backdrop-blur-sm">
            <div className="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 lg:px-8">
              <Link to="/" className="flex items-center gap-3">
                <img
                  src="/site-assets/images/home/logo.svg"
                  alt="Imaging Services logo"
                  className="h-10 w-auto"
                />
                <div>
                  <p className="text-lg font-bold tracking-wide text-brand-deep">
                    {asText(company.name) || "Imaging Services"}
                  </p>
                  <p className="text-xs uppercase tracking-[0.2em] text-brand-accent">
                    Imaging Services USA
                  </p>
                </div>
              </Link>

              <nav
                className="hidden items-center gap-1 lg:flex"
                aria-label="Primary"
              >
                {navigation.map((item) => {
                  const navItem = toRecord(item);
                  const to = asText(navItem.url);

                  return (
                    <NavLink
                      key={asText(navItem.label)}
                      to={to}
                      className={({ isActive }) =>
                        `rounded-full px-4 py-2 text-sm font-semibold transition ${
                          isActive
                            ? "bg-brand-deep text-white shadow-sm"
                            : "text-brand-muted hover:bg-brand-soft hover:text-brand-deep"
                        }`
                      }
                    >
                      {asText(navItem.label)}
                    </NavLink>
                  );
                })}
              </nav>

              <div className="hidden items-center gap-2 lg:flex">
                <a href={asText(urls.tollFreeDial)} className="btn-secondary">
                  {asText(urls.tollFreePhone)}
                </a>
                <Link to="/payments" className="btn-primary">
                  Payments
                </Link>
              </div>
            </div>

            <div className="border-t border-brand-ink/10 bg-white p-4 lg:hidden">
              <div className="mx-auto flex max-w-7xl flex-col gap-2">
                {navigation.map((item) => {
                  const navItem = toRecord(item);
                  return (
                    <NavLink
                      key={asText(navItem.label)}
                      to={asText(navItem.url)}
                      className={({ isActive }) =>
                        `rounded-xl px-3 py-2 text-sm font-medium ${
                          isActive
                            ? "bg-brand-deep text-white"
                            : "text-brand-muted hover:bg-brand-soft hover:text-brand-deep"
                        }`
                      }
                    >
                      {asText(navItem.label)}
                    </NavLink>
                  );
                })}
                <Link
                  to="/payments"
                  className="rounded-xl bg-brand-deep px-3 py-2 text-sm font-semibold text-white"
                >
                  Payments
                </Link>
                <a
                  href={asText(urls.tollFreeDial)}
                  className="rounded-xl border border-brand-ink/20 px-3 py-2 text-sm font-semibold text-brand-deep"
                >
                  {asText(urls.tollFreePhone)}
                </a>
              </div>
            </div>
          </header>

          <main>
            <Outlet />
          </main>

          <footer className="mt-20 border-t border-brand-ink/10 bg-brand-deep text-brand-soft">
            <div className="mx-auto grid max-w-7xl gap-8 px-4 py-14 lg:grid-cols-3 lg:px-8">
              <div>
                <p className="text-2xl font-bold">{asText(company.name)}</p>
                <p className="mt-3 max-w-md text-sm text-brand-soft/85">
                  {asText(company.tagline)}
                </p>
              </div>
              <div>
                <p className="text-sm font-semibold uppercase tracking-[0.18em] text-brand-accent">
                  Contact
                </p>
                <p className="mt-3 text-sm">
                  Toll Free: {asText(company.phone_toll_free)}
                </p>
                <p className="mt-1 text-sm">
                  Main: {asText(company.phone_primary)}
                </p>
                <p className="mt-1 text-sm">
                  Orders: {asText(company.email_orders)}
                </p>
                <p className="mt-1 text-sm">HQ: {asText(company.hq_address)}</p>
              </div>
              <div>
                <p className="text-sm font-semibold uppercase tracking-[0.18em] text-brand-accent">
                  Quick Links
                </p>
                <div className="mt-3 flex flex-wrap gap-2 text-sm">
                  {quickLinks.map((item) => {
                    const link = toRecord(item);

                    return (
                      <Link
                        key={asText(link.label)}
                        to={asText(link.url)}
                        className="rounded-full border border-brand-soft/30 px-3 py-1.5 transition hover:bg-brand-soft hover:text-brand-deep"
                      >
                        {asText(link.label)}
                      </Link>
                    );
                  })}
                </div>
              </div>
            </div>
            <div className="border-t border-brand-soft/20">
              <div className="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-4 text-xs text-brand-soft/85 lg:px-8">
                <p>
                  &copy; {new Date().getFullYear()}{" "}
                  {asText(company.legal_name) || asText(company.name)}. All
                  rights reserved.
                </p>
                <Link
                  to="/privacy-policy-terms-of-use"
                  className="hover:text-white"
                >
                  Privacy Policy
                </Link>
              </div>
            </div>
          </footer>
        </div>
        <ScrollRestoration />
        <Scripts />
      </body>
    </html>
  );
}

export function ErrorBoundary(): React.JSX.Element {
  const error = useRouteError();
  const message = isRouteErrorResponse(error)
    ? `${error.status} ${error.statusText}`
    : "Unexpected error";

  return (
    <html lang="en">
      <head>
        <meta charSet="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Imaging Services</title>
      </head>
      <body className="site-body antialiased">
        <section className="page-shell page-shell-medium page-section">
          <div className="surface-card p-6 md:p-8">
            <p className="brand-pill">Error</p>
            <h1 className="mt-4 page-title text-brand-deep">
              Page unavailable
            </h1>
            <p className="mt-4 page-body">{message}</p>
            <Link to="/" className="btn-primary mt-6">
              Return Home
            </Link>
          </div>
        </section>
        <Scripts />
      </body>
    </html>
  );
}
