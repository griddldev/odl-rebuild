import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps, RichText } from "@wordpress/block-editor";
import { ColorPalette, BaseControl } from "@wordpress/components";
import { useState } from "@wordpress/element";
import { TabSelector } from "../components/backend/TabSelector.jsx";
import { LinkPicker } from "../components/backend/LinkPicker.jsx";
import {
  BRAND_COLORS,
  slugFromHex,
  hexFromSlug,
} from "../components/backend/brand-palette.js";

registerBlockType("sage/card-grid", {
  edit: ({ attributes, setAttributes }) => {
    const { heading, subtitle, body, cards } = attributes;
    const blockProps = useBlockProps({ style: { marginBottom: "10px" } });
    const [activeCard, setActiveCard] = useState(0);

    const items = cards ?? [];
    const index = Math.min(activeCard, Math.max(items.length - 1, 0));
    const card = items[index] ?? {};

    const updateCard = (field, value) => {
      const updated = [...items];
      updated[index] = { ...updated[index], [field]: value };
      setAttributes({ cards: updated });
    };

    return (
      <div
        {...blockProps}
        className="card-grid-editor border-2 border-dashed border-green-300 bg-green-50 p-8"
      >
        <div className="mb-4 flex items-center gap-3">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="2"
            strokeLinecap="round"
            strokeLinejoin="round"
          >
            <rect x="3" y="3" width="7" height="7" />
            <rect x="14" y="3" width="7" height="7" />
            <rect x="3" y="14" width="7" height="7" />
            <rect x="14" y="14" width="7" height="7" />
          </svg>
          <span className="text-lg font-bold">Card Grid</span>
        </div>

        {/* Section heading */}
        <div className="mb-4">
          <p className="mb-2 text-sm font-semibold">Section Heading</p>
          <RichText
            tagName="h2"
            value={heading}
            onChange={(value) => setAttributes({ heading: value })}
            placeholder="e.g. Join Us"
            allowedFormats={["core/bold", "core/italic"]}
          />
        </div>

        {/* Section subtitle */}
        <div className="mb-4">
          <p className="mb-2 text-sm font-semibold">Section Subtitle</p>
          <RichText
            tagName="div"
            value={subtitle}
            onChange={(value) => setAttributes({ subtitle: value })}
            placeholder="Enter subtitle..."
            allowedFormats={["core/bold", "core/italic"]}
          />
        </div>

        {/* Section body */}
        <div className="mb-6">
          <p className="mb-2 text-sm font-semibold">Section Body</p>
          <RichText
            tagName="div"
            value={body}
            onChange={(value) => setAttributes({ body: value })}
            placeholder="Enter body text..."
            allowedFormats={["core/bold", "core/italic"]}
          />
        </div>

        {/* Cards — fixed at 4 to match the section layout */}
        <TabSelector
          items={items}
          activeItem={index}
          setActiveItem={setActiveCard}
          addItem={null}
          itemLabelPrefix="Card"
        />

        <div className="rounded-lg border border-gray-200 bg-white p-4">
          <div className="mb-4">
            <BaseControl __nextHasNoMarginBottom label="Background Color">
              <ColorPalette
                colors={BRAND_COLORS}
                value={hexFromSlug(card.backgroundColor)}
                onChange={(hex) =>
                  updateCard("backgroundColor", slugFromHex(hex) || "pink")
                }
                disableCustomColors
                clearable={false}
              />
            </BaseControl>
          </div>

          <div className="mb-3">
            <p className="mb-2 text-sm font-semibold">Title</p>
            <RichText
              tagName="div"
              value={card.title}
              onChange={(value) => updateCard("title", value)}
              placeholder="e.g. Donate"
              allowedFormats={["core/bold", "core/italic"]}
            />
          </div>

          <div className="mb-3">
            <p className="mb-2 text-sm font-semibold">Subtitle</p>
            <RichText
              tagName="div"
              value={card.subtitle}
              onChange={(value) => updateCard("subtitle", value)}
              placeholder="Enter card subtitle..."
              allowedFormats={["core/bold", "core/italic"]}
            />
          </div>

          <div className="mb-3">
            <p className="mb-2 text-sm font-semibold">Body</p>
            <RichText
              tagName="div"
              value={card.body}
              onChange={(value) => updateCard("body", value)}
              placeholder="Enter card body text..."
              allowedFormats={["core/bold", "core/italic"]}
            />
          </div>

          <div className="rounded border border-gray-100 bg-gray-50 p-3">
            <p className="mb-2 text-sm font-semibold">CTA Link</p>
            <RichText
              tagName="div"
              value={card.linkText}
              onChange={(value) => updateCard("linkText", value)}
              placeholder="e.g. Donate Now"
              allowedFormats={["core/bold", "core/italic"]}
            />
            <LinkPicker
              className="mt-2"
              label="Link"
              value={card.link}
              onChange={(value) => updateCard("link", value)}
            />
          </div>
        </div>
      </div>
    );
  },
  save: () => null,
});
