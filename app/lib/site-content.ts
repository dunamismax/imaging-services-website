import content from "../content/site-content.json";

type UnknownRecord = Record<string, unknown>;

type NavigationItem = {
  label: string;
  url: string;
  routeName: string;
};

type QuickLink = {
  label: string;
  url: string;
};

const siteContent = content as UnknownRecord;

function asRecord(value: unknown): UnknownRecord {
  return value && typeof value === "object" ? (value as UnknownRecord) : {};
}

function asArray<T = unknown>(value: unknown): T[] {
  return Array.isArray(value) ? (value as T[]) : [];
}

function asString(value: unknown): string {
  return typeof value === "string" ? value : "";
}

function digitsOnly(value: string): string {
  return value.replace(/[^\d+]/g, "");
}

export function getSiteData(): UnknownRecord {
  const company = asRecord(siteContent.company);
  const tollFreePhone = asString(company.phone_toll_free);

  const navigation: NavigationItem[] = [
    { label: "Home", url: "/", routeName: "home" },
    { label: "Equipment", url: "/equipment", routeName: "equipment" },
    { label: "Services", url: "/services", routeName: "services" },
    { label: "Accessories", url: "/accessories", routeName: "accessories" },
    { label: "About", url: "/about-us", routeName: "about" },
    { label: "Media", url: "/media", routeName: "media" },
    { label: "Contact", url: "/contact-us", routeName: "contact" },
  ];

  const quickLinks: QuickLink[] = [
    { label: "Privacy & Terms", url: "/privacy-policy-terms-of-use" },
    { label: "Refunds", url: "/refund_returns" },
    { label: "Careers", url: "/careers" },
  ];

  return {
    company,
    hours: asArray(siteContent.hours),
    partners: asArray(siteContent.partners),
    navigation,
    quickLinks,
    urls: {
      home: "/",
      equipment: "/equipment",
      services: "/services",
      media: "/media",
      payments: "/payments",
      contact: "/contact-us",
      privacy: "/privacy-policy-terms-of-use",
      tollFreePhone,
      tollFreeDial: `tel:${digitsOnly(tollFreePhone)}`,
    },
  };
}

export function getHome(): UnknownRecord {
  const home = asRecord(siteContent.home);
  const hero = asRecord(home.hero);

  return {
    ...home,
    hero: {
      ...hero,
      primary_cta: {
        ...asRecord(hero.primary_cta),
        url: "/equipment",
      },
      secondary_cta: {
        ...asRecord(hero.secondary_cta),
        url: "/contact-us",
      },
    },
    categories: asArray(home.categories).map((category) => {
      const categoryRecord = asRecord(category);

      return {
        ...categoryRecord,
        url: `/equipment/${asString(categoryRecord.slug)}`,
      };
    }),
  };
}

export function getAbout(): UnknownRecord {
  return asRecord(siteContent.about);
}

export function getEquipment(): UnknownRecord {
  const equipment = asRecord(siteContent.equipment);

  return {
    ...equipment,
    categories: asArray(equipment.categories).map((item) => {
      const category = asRecord(item);

      return {
        ...category,
        url: `/equipment/${asString(category.slug)}`,
      };
    }),
  };
}

export function getEquipmentDetail(slug: string): UnknownRecord | null {
  const map = asRecord(siteContent.equipment_details);
  const equipment = asRecord(map[slug]);

  if (Object.keys(equipment).length === 0) {
    return null;
  }

  return {
    ...equipment,
    backUrl: "/equipment",
  };
}

export function getServices(): UnknownRecord {
  return asRecord(siteContent.services);
}

export function getAccessories(): UnknownRecord {
  return asRecord(siteContent.accessories);
}

export function getContact(): UnknownRecord {
  return asRecord(siteContent.contact);
}

export function getPayments(): UnknownRecord {
  return asRecord(siteContent.payments);
}

export function getPrivacy(): UnknownRecord {
  return asRecord(siteContent.privacy);
}

export function getMediaPosts(): Record<string, UnknownRecord> {
  const posts = asRecord(siteContent.blog_posts);

  return Object.fromEntries(
    Object.entries(posts).map(([slug, post]) => [
      slug,
      {
        ...asRecord(post),
        url: `/${slug}`,
      },
    ]),
  );
}

export function getBlogPost(slug: string): UnknownRecord | null {
  const post = asRecord(asRecord(siteContent.blog_posts)[slug]);

  if (Object.keys(post).length === 0) {
    return null;
  }

  return {
    ...post,
    backUrl: "/media",
  };
}

export function getMarketingPage(slug: string): UnknownRecord | null {
  const page = asRecord(asRecord(siteContent.marketing_pages)[slug]);

  if (Object.keys(page).length === 0) {
    return null;
  }

  const cta = asRecord(page.cta);
  const route = asString(cta.route);

  const ctaUrlMap: Record<string, string> = {
    home: "/",
    equipment: "/equipment",
    services: "/services",
    accessories: "/accessories",
    contact: "/contact-us",
    payments: "/payments",
    privacy: "/privacy-policy-terms-of-use",
    media: "/media",
  };

  return {
    ...page,
    cta,
    ctaUrl: ctaUrlMap[route] ?? "/",
    homeUrl: "/",
  };
}

export function getAllDynamicSlugs(): string[] {
  const postSlugs = Object.keys(asRecord(siteContent.blog_posts));
  const marketingSlugs = Object.keys(asRecord(siteContent.marketing_pages));

  return [...postSlugs, ...marketingSlugs];
}

export function toRecord(value: unknown): UnknownRecord {
  return asRecord(value);
}

export function toArray<T = unknown>(value: unknown): T[] {
  return asArray<T>(value);
}

export function asText(value: unknown): string {
  return asString(value);
}
