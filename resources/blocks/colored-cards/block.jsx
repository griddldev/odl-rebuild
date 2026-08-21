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

registerBlockType("sage/colored-cards", {
  edit: ({ attributes, setAttributes }) => {
    const { heading, description, cards } = attributes;
    const blockProps = useBlockProps();
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
        className="colored-cards-editor border-2 border-dashed border-purple-300 bg-purple-50 p-8"
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
            <rect x="1" y="3" width="7" height="18" rx="1" />
            <rect x="9" y="3" width="7" height="18" rx="1" />
            <rect x="17" y="3" width="7" height="18" rx="1" />
          </svg>
          <span className="text-lg font-bold">Colored Cards</span>
        </div>

        {/* Section heading */}
        <div className="mb-4">
          <p className="mb-2 text-sm font-semibold">Section Heading</p>
          <RichText
            tagName="h2"
            value={heading}
            onChange={(value) => setAttributes({ heading: value })}
            placeholder="Enter section heading..."
            allowedFormats={["core/bold", "core/italic"]}
          />
        </div>

        {/* Section description */}
        <div className="mb-6">
          <p className="mb-2 text-sm font-semibold">Section Description</p>
          <RichText
            tagName="div"
            value={description}
            onChange={(value) => setAttributes({ description: value })}
            placeholder="Enter section description..."
            allowedFormats={["core/bold", "core/italic"]}
          />
        </div>

        {/* Cards — fixed at 3 to match the lg:grid-cols-3 layout */}
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
                  updateCard("backgroundColor", slugFromHex(hex) || "blue")
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
              placeholder="e.g. Educate"
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

          <div className="mb-3 rounded border border-gray-100 bg-gray-50 p-3">
            <p className="mb-2 text-sm font-semibold">Link 1</p>
            <RichText
              tagName="div"
              value={card.link1Text}
              onChange={(value) => updateCard("link1Text", value)}
              placeholder="e.g. Explore Youth Programs"
              allowedFormats={["core/bold", "core/italic"]}
            />
            <LinkPicker
              className="mt-2"
              label="Link"
              value={card.link1}
              onChange={(value) => updateCard("link1", value)}
            />
          </div>

          <div className="rounded border border-gray-100 bg-gray-50 p-3">
            <p className="mb-2 text-sm font-semibold">Link 2 (optional)</p>
            <RichText
              tagName="div"
              value={card.link2Text}
              onChange={(value) => updateCard("link2Text", value)}
              placeholder="e.g. Explore Training & Courses"
              allowedFormats={["core/bold", "core/italic"]}
            />
            <LinkPicker
              className="mt-2"
              label="Link"
              value={card.link2}
              onChange={(value) => updateCard("link2", value)}
            />
          </div>
        </div>
      </div>
    );
  },
  save: () => null,
});
