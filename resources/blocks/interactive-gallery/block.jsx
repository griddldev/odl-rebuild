import { registerBlockType } from "@wordpress/blocks";
import {
  useBlockProps,
  RichText,
  MediaUpload,
  MediaUploadCheck,
} from "@wordpress/block-editor";
import { ColorPalette, BaseControl } from "@wordpress/components";
import { useState } from "@wordpress/element";
import { ImageUploadWithHover } from "../components/backend/ImageUploadWithHover.jsx";
import { TabSelector } from "../components/backend/TabSelector.jsx";
import {
  BRAND_COLORS,
  slugFromHex,
  hexFromSlug,
} from "../components/backend/brand-palette.js";

registerBlockType("sage/interactive-gallery", {
  edit: ({ attributes, setAttributes }) => {
    const { heading, items } = attributes;
    const blockProps = useBlockProps({ style: { marginBottom: "10px" } });
    const [activeItem, setActiveItem] = useState(0);

    const list = items ?? [];
    const index = Math.min(activeItem, Math.max(list.length - 1, 0));
    const item = list[index] ?? {};

    const updateItemMany = (data) => {
      const updated = [...list];
      updated[index] = { ...updated[index], ...data };
      setAttributes({ items: updated });
    };

    const updateItem = (field, value) => updateItemMany({ [field]: value });

    return (
      <div
        {...blockProps}
        className="interactive-gallery-editor border-2 border-dashed border-yellow-300 bg-yellow-50 p-8"
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
            <rect x="2" y="2" width="20" height="20" rx="2" />
            <path d="M2 10h20" />
            <path d="M10 2v20" />
          </svg>
          <span className="text-lg font-bold">Interactive Gallery</span>
        </div>

        {/* Section heading */}
        <div className="mb-6">
          <p className="mb-2 text-sm font-semibold">Section Heading</p>
          <RichText
            tagName="h2"
            value={heading}
            onChange={(value) => setAttributes({ heading: value })}
            placeholder="Enter section heading..."
            allowedFormats={["core/bold", "core/italic"]}
          />
        </div>

        {/* Items — fixed at 3 to match the gallery layout */}
        <TabSelector
          items={list}
          activeItem={index}
          setActiveItem={setActiveItem}
          addItem={null}
          itemLabelPrefix="Item"
        />

        <div className="rounded-lg border border-gray-200 bg-white p-4">
          {/* Image */}
          <div className="mb-4">
            <MediaUploadCheck>
              <ImageUploadWithHover
                MediaUpload={MediaUpload}
                imageUrl={item.imageUrl}
                imageId={item.imageId}
                onSelect={(media) =>
                  updateItemMany({
                    imageUrl: media?.url || "",
                    imageId: media?.id ?? null,
                    imageAlt: media?.alt ?? "",
                  })
                }
                onRemove={() =>
                  updateItemMany({
                    imageUrl: "",
                    imageId: null,
                    imageAlt: "",
                  })
                }
                height={160}
              />
            </MediaUploadCheck>
          </div>

          {/* Active Color */}
          <div className="mb-4">
            <BaseControl
              __nextHasNoMarginBottom
              label="Background Color (on click)"
            >
              <ColorPalette
                colors={BRAND_COLORS}
                value={hexFromSlug(item.activeColor)}
                onChange={(hex) =>
                  updateItem("activeColor", slugFromHex(hex) || "teal")
                }
                disableCustomColors
                clearable={false}
              />
            </BaseControl>
          </div>

          {/* Title */}
          <div className="mb-3">
            <p className="mb-2 text-sm font-semibold">Title</p>
            <RichText
              tagName="div"
              value={item.title}
              onChange={(value) => updateItem("title", value)}
              placeholder="Enter item title..."
              allowedFormats={["core/bold", "core/italic"]}
            />
          </div>

          {/* Description */}
          <div>
            <p className="mb-2 text-sm font-semibold">Description</p>
            <RichText
              tagName="div"
              value={item.description}
              onChange={(value) => updateItem("description", value)}
              placeholder="Enter item description..."
              allowedFormats={["core/bold", "core/italic"]}
            />
          </div>
        </div>
      </div>
    );
  },
  save: () => null,
});
