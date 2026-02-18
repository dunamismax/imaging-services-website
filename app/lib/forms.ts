import { z } from "zod";

const sharedFields = {
  name: z.string().min(2).max(60),
  phone: z.string().min(10).max(18),
  email: z.email().max(255),
  notes: z.string().max(1000).optional().or(z.literal("")),
};

export const contactSalesSchema = z.object({
  ...sharedFields,
  company: z.string().min(2).max(60).optional().or(z.literal("")),
});

export const selectableRequestSchema = z
  .object({
    ...sharedFields,
    formKey: z.enum(["service-request", "training-request"]),
    requireCompany: z.boolean().default(true),
    company: z.string().max(60),
    selectedOptions: z.array(z.string()).min(1),
    options: z.array(z.string()),
  })
  .superRefine((value, ctx) => {
    if (value.requireCompany && value.company.trim().length < 2) {
      ctx.addIssue({
        code: z.ZodIssueCode.custom,
        path: ["company"],
        message: "Your company is required.",
      });
    }

    const invalidSelections = value.selectedOptions.filter(
      (option) => !value.options.includes(option),
    );

    if (invalidSelections.length > 0) {
      ctx.addIssue({
        code: z.ZodIssueCode.custom,
        path: ["selectedOptions"],
        message: "Select valid options.",
      });
    }
  });

export type ContactSalesInput = z.infer<typeof contactSalesSchema>;
export type SelectableRequestInput = z.infer<typeof selectableRequestSchema>;
