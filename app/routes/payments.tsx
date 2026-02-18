import { Link } from "react-router";

import {
  asText,
  getPayments,
  getSiteData,
  toRecord,
} from "../lib/site-content";

export default function PaymentsRoute(): React.JSX.Element {
  const payments = toRecord(getPayments());
  const site = toRecord(getSiteData());
  const company = toRecord(site.company);

  return (
    <section className="page-shell page-shell-medium page-section">
      <div className="surface-card p-6 md:p-8">
        <p className="brand-pill">Payments</p>
        <h1 className="mt-4 page-title text-brand-deep">
          Send deposits and checks to Imaging Services
        </h1>
        <p className="mt-4 max-w-3xl page-body">
          Need help choosing the right payment method? Contact our team before
          sending funds and we will route you to the correct process.
        </p>
      </div>

      <div className="mt-8 grid gap-5 md:grid-cols-2">
        <article className="surface-card p-6">
          <h2 className="card-title text-brand-deep">
            Send Deposits and Checks
          </h2>
          <p className="mt-4 text-sm uppercase tracking-[0.14em] text-brand-accent">
            {asText(toRecord(payments.mailing).company)}
          </p>
          <p className="mt-2 page-body">
            {asText(toRecord(payments.mailing).address)}
          </p>
        </article>

        <article className="surface-card p-6">
          <h2 className="card-title text-brand-deep">
            {asText(toRecord(payments.bank_transfer).title)}
          </h2>
          <p className="mt-3 page-body">
            {asText(toRecord(payments.bank_transfer).note)}
          </p>
          <Link to="/contact-us" className="btn-secondary mt-5">
            Request Transfer Details
          </Link>
        </article>
      </div>

      <article className="surface-card mt-5 p-6">
        <h2 className="card-title text-brand-deep">Credit Cards</h2>
        <p className="mt-3 page-body">{asText(payments.card_note)}</p>
        <div className="mt-5 flex flex-wrap gap-3">
          <a
            href={`tel:${asText(company.phone_toll_free).replace(/[^\d+]/g, "")}`}
            className="btn-primary"
          >
            Call {asText(company.phone_toll_free)}
          </a>
          <Link to="/contact-us" className="btn-secondary">
            Submit Payment Question
          </Link>
        </div>
      </article>
    </section>
  );
}
