import { index, type RouteConfig, route } from "@react-router/dev/routes";

export default [
  index("routes/home.tsx"),
  route("about-us", "routes/about.tsx"),
  route("equipment", "routes/equipment.tsx"),
  route("equipment/:equipmentSlug", "routes/equipment-detail.tsx"),
  route("services", "routes/services.tsx"),
  route("accessories", "routes/accessories.tsx"),
  route("contact-us", "routes/contact.tsx"),
  route("contact", "routes/contact-alias.tsx"),
  route("payments", "routes/payments.tsx"),
  route("privacy-policy-terms-of-use", "routes/privacy.tsx"),
  route("privacy-policy-terms", "routes/privacy-legacy.tsx"),
  route("media", "routes/media.tsx"),
  route(":slug", "routes/slug.tsx"),
] satisfies RouteConfig;
