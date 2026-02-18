<p align="center">
  <img src="public/favicon.svg" alt="Imaging Services logo" width="84" />
</p>

<p align="center">
  Bun + React Router + TypeScript rewrite of the Imaging Services USA website.
</p>

# Imaging Services Website

This repository now runs fully on Bun/TypeScript with React Router (framework mode, SPA-first), Tailwind CSS, shadcn/ui primitives, and a Bun API backed by Postgres + Drizzle for lead form submissions.

## Stack

- Runtime/tooling: Bun, Biome
- Frontend: Vite + React Router framework mode (`ssr: false`), React 19.2, TypeScript
- Styling/UI: Tailwind CSS v4, shadcn/ui-style components
- Data/API: Bun server, Postgres, Drizzle ORM + drizzle-kit
- Validation: Zod (client/server form payloads + server env)

## Setup

1. Install dependencies

```bash
bun install
```

2. Configure environment

```bash
cp .env.example .env
# update DATABASE_URL if needed
```

3. Run migration

```bash
bun run db:migrate
```

4. Start apps (two terminals)

```bash
bun run dev:server
bun run dev
```

- Frontend: http://localhost:5173
- API: http://localhost:3001

## Commands

```bash
bun run dev
bun run dev:server
bun run build
bun run lint
bun run format
bun run typecheck
bun run db:generate
bun run db:migrate
bun run db:studio
```

## Route Coverage Preserved

Public routes are preserved from the Laravel site, including:

- `/`
- `/about-us`
- `/equipment`
- `/equipment/:equipmentSlug`
- `/services`
- `/accessories`
- `/contact-us`
- `/contact`
- `/payments`
- `/privacy-policy-terms-of-use`
- `/privacy-policy-terms`
- `/media`
- `/:slug` for media posts and marketing pages

## Forms

The following forms post to the Bun API and persist into Postgres (`form_submissions`):

- Contact sales
- Service request
- Training request

The API enforces payload validation with Zod and basic IP+form rate limiting.

## Notes

- `public/site-assets/**` content and imagery are preserved from the prior implementation.
- Auth.js is intentionally not enabled because this website has no login requirement.

## License

MIT
