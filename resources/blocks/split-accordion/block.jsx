import { registerBlockType } from "@wordpress/blocks";
import {
  useBlockProps,
  RichText,
  MediaUpload,
  MediaUploadCheck,
} from "@wordpress/block-editor";
import { Button } from "@wordpress/components";
import { useState } from "@wordpress/element";
import { ImageUploadWithHover } from "../components/backend/ImageUploadWithHover.jsx";
import { LinkPicker } from "../components/backend/LinkPicker.jsx";
import { TabSelector } from "../components/backend/TabSelector.jsx";

registerBlockType("sage/split-accordion", {
  edit: ({ attributes, setAttributes }) => {
    const { heading, subtitleFaded, subtitleMain, imageUrl, imageId, items } =
      attributes;
    const blockProps = useBlockProps({ style: { marginBottom: "10px" } });
    const [activeItem, setActiveItem] = useState(0);

    const list = items ?? [];
    const index = Math.min(activeItem, Math.max(list.length - 1, 0));
    const item = list[index] ?? {};

    const updateItem = (field, value) => {
      const updated = [...list];
      updated[index] = { ...updated[index], [field]: value };
      setAttributes({ items: updated });
    };

    const addItem = () => {
      const updated = [...list];
      updated.push({
        title: "",
        content: "",
        linkText: "",
        link: { url: "", opensInNewTab: false },
      });
      setAttributes({ items: updated });
    };

    const removeItem = () => {
      setAttributes({ items: list.filter((_, i) => i !== index) });
      setActiveItem(Math.max(index - 1, 0));
    };

    return (
      <div
        {...blockProps}
        className="split-accordion-editor border-2 border-dashed border-amber-300 bg-amber-50 p-8"
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
            <line x1="3" y1="6" x2="21" y2="6" />
            <line x1="3" y1="12" x2="21" y2="12" />
            <line x1="3" y1="18" x2="21" y2="18" />
            <polyline points="15 6 18 3 21 6" />
          </svg>
          <span className="text-lg font-bold">Split Accordion</span>
        </div>

        {/* Heading */}
        <div className="mb-4">
          <p className="mb-2 text-sm font-semibold">Section Heading</p>
          <RichText
            tagName="h2"
            value={heading}
            onChange={(value) => setAttributes({ heading: value })}
            placeholder="e.g. Find Your Path"
            allowedFormats={["core/bold", "core/italic"]}
          />
        </div>

        {/* Subtitle Faded (50% opacity) */}
        <div className="mb-4">
          <p className="mb-2 text-sm font-semibold">
            Subtitle Top (50% opacity)
          </p>
          <RichText
            tagName="div"
            value={subtitleFaded}
            onChange={(value) => setAttributes({ subtitleFaded: value })}
            placeholder="Enter faded subtitle text..."
            allowedFormats={["core/bold", "core/italic"]}
          />
        </div>

        {/* Subtitle Main */}
        <div className="mb-6">
          <p className="mb-2 text-sm font-semibold">Subtitle Bottom</p>
          <RichText
            tagName="div"
            value={subtitleMain}
            onChange={(value) => setAttributes({ subtitleMain: value })}
            placeholder="Enter main subtitle text..."
            allowedFormats={["core/bold", "core/italic"]}
          />
        </div>

        {/* Image */}
        <div className="mb-6">
          <p className="mb-2 text-sm font-semibold">Image</p>
          <MediaUploadCheck>
            <ImageUploadWithHover
              MediaUpload={MediaUpload}
              imageUrl={imageUrl}
              imageId={imageId}
              onSelect={(media) =>
                setAttributes({
                  imageUrl: media?.url || "",
                  imageId: media?.id ?? null,
                  imageAlt: media?.alt ?? "",
                })
              }
              onRemove={() =>
                setAttributes({
                  imageUrl: "",
                  imageId: null,
                  imageAlt: "",
                })
              }
              height={200}
            />
          </MediaUploadCheck>
        </div>

        {/* Accordion items */}
        <TabSelector
          items={list}
          activeItem={index}
          setActiveItem={setActiveItem}
          addItem={addItem}
          addButtonLabel="+ Add item"
          itemLabelPrefix="Item"
        />

        <div className="rounded-lg border border-gray-200 bg-white p-4">
          {list.length > 1 && (
            <div className="mb-2 flex justify-end">
              <Button isDestructive variant="tertiary" onClick={removeItem}>
                ✕ Remove item
              </Button>
            </div>
          )}

          <div className="mb-3">
            <p className="mb-2 text-sm font-semibold">Title</p>
            <RichText
              tagName="div"
              value={item.title}
              onChange={(value) => updateItem("title", value)}
              placeholder="e.g. I need naloxone"
              allowedFormats={["core/bold", "core/italic"]}
            />
          </div>

          <div className="mb-3">
            <p className="mb-2 text-sm font-semibold">Content</p>
            <RichText
              tagName="div"
              value={item.content}
              onChange={(value) => updateItem("content", value)}
              placeholder="Enter accordion content..."
              allowedFormats={["core/bold", "core/italic"]}
            />
          </div>

          <div className="rounded border border-gray-100 bg-gray-50 p-3">
            <p className="mb-2 text-sm font-semibold">CTA Button (optional)</p>
            <RichText
              tagName="div"
              value={item.linkText}
              onChange={(value) => updateItem("linkText", value)}
              placeholder="e.g. Get Free Naloxone"
              allowedFormats={["core/bold", "core/italic"]}
            />
            <LinkPicker
              className="mt-2"
              label="Link"
              value={item.link}
              onChange={(value) => updateItem("link", value)}
            />
          </div>
        </div>
      </div>
    );
  },
  save: () => null,
});
