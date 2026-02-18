import {
  bigserial,
  jsonb,
  pgTable,
  text,
  timestamp,
} from "drizzle-orm/pg-core";

export const formSubmissions = pgTable("form_submissions", {
  id: bigserial("id", { mode: "number" }).primaryKey(),
  formType: text("form_type").notNull(),
  name: text("name").notNull(),
  phone: text("phone").notNull(),
  email: text("email").notNull(),
  company: text("company"),
  selectedOptions: jsonb("selected_options").$type<string[] | null>(),
  notes: text("notes"),
  ipAddress: text("ip_address"),
  createdAt: timestamp("created_at", { withTimezone: true })
    .defaultNow()
    .notNull(),
});
