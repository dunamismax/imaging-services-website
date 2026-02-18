CREATE TABLE IF NOT EXISTS "form_submissions" (
  "id" bigserial PRIMARY KEY,
  "form_type" text NOT NULL,
  "name" text NOT NULL,
  "phone" text NOT NULL,
  "email" text NOT NULL,
  "company" text,
  "selected_options" jsonb,
  "notes" text,
  "ip_address" text,
  "created_at" timestamp with time zone NOT NULL DEFAULT now()
);
