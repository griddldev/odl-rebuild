/**
 * Brand palette shared by every block that exposes a color field.
 *
 * Mirrors the tokens in resources/css/variables.css. Blocks store the
 * `slug`; Blade resolves it to a Tailwind class (bg-<slug>) or, where the
 * front end needs the literal value at runtime, to `color` via BRAND_HEX.
 */
export const BRAND_COLORS = [
  { name: "Blue", slug: "blue", color: "#4bc3ff" },
  { name: "Yellow", slug: "yellow", color: "#fddd4f" },
  { name: "Pink", slug: "pink", color: "#f2c8f7" },
  { name: "Teal", slug: "teal", color: "#42b289" },
  { name: "Off White", slug: "off-white", color: "#ebefe6" },
];

/** ColorPalette hands back a hex string; map it back to the stored slug. */
export const slugFromHex = (hex) =>
  BRAND_COLORS.find((c) => c.color.toLowerCase() === String(hex).toLowerCase())
    ?.slug ?? "";

export const hexFromSlug = (slug) =>
  BRAND_COLORS.find((c) => c.slug === slug)?.color ?? "";
