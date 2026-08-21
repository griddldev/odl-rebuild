import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps, RichText } from "@wordpress/block-editor";
import { Button } from "@wordpress/components";
import { useState } from "@wordpress/element";
import { TabSelector } from "../components/backend/TabSelector.jsx";

registerBlockType("sage/crooked-carousel", {
  edit: ({ attributes, setAttributes }) => {
    const { heading, subtitle, items } = attributes;
    const blockProps = useBlockProps();

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
      updated.push({ stat: "", description: "" });
      setAttributes({ items: updated });
    };

    const removeItem = () => {
      setAttributes({ items: list.filter((_, i) => i !== index) });
      setActiveItem(Math.max(index - 1, 0));
    };

    return (
      <div
        {...blockProps}
        className="crooked-carousel-editor border-2 border-dashed border-blue-300 bg-blue-50 p-8"
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
            <rect x="2" y="6" width="20" height="12" rx="2" />
            <path d="M12 12h.01" />
            <path d="M17 12h.01" />
            <path d="M7 12h.01" />
          </svg>
          <span className="text-lg font-bold">Crooked Carousel</span>
        </div>

        {/* Heading */}
        <div className="mb-4">
          <p className="mb-2 text-sm font-semibold">Heading</p>
          <RichText
            tagName="h2"
            value={heading}
            onChange={(value) => setAttributes({ heading: value })}
            placeholder="e.g. Our Impact"
            allowedFormats={["core/bold", "core/italic"]}
          />
        </div>

        {/* Subtitle */}
        <div className="mb-6">
          <p className="mb-2 text-sm font-semibold">Subtitle</p>
          <RichText
            tagName="div"
            value={subtitle}
            onChange={(value) => setAttributes({ subtitle: value })}
            placeholder="Enter subtitle..."
            allowedFormats={["core/bold", "core/italic"]}
          />
        </div>

        {/* Items */}
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
            <p className="mb-2 text-sm font-semibold">Stat</p>
            <RichText
              tagName="div"
              value={item.stat}
              onChange={(value) => updateItem("stat", value)}
              placeholder="e.g. 19%"
              allowedFormats={["core/bold", "core/italic"]}
            />
          </div>

          <div>
            <p className="mb-2 text-sm font-semibold">Description</p>
            <RichText
              tagName="div"
              value={item.description}
              onChange={(value) => updateItem("description", value)}
              placeholder="e.g. Reduction in Indiana's statewide overdose death rate"
              allowedFormats={["core/bold", "core/italic"]}
            />
          </div>
        </div>
      </div>
    );
  },
  save: () => null,
});
