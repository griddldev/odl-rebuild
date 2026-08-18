import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';

registerBlockType('sage/crooked-carousel', {
  edit: ({ attributes, setAttributes }) => {
    const { heading, subtitle, items } = attributes;
    const blockProps = useBlockProps();

    const updateItem = (index, field, value) => {
      const updated = [...(items ?? [])];
      updated[index] = { ...updated[index], [field]: value };
      setAttributes({ items: updated });
    };

    const addItem = () => {
      const updated = [...(items ?? [])];
      updated.push({ stat: '', description: '' });
      setAttributes({ items: updated });
    };

    const removeItem = (index) => {
      const updated = (items ?? []).filter((_, i) => i !== index);
      setAttributes({ items: updated });
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
            allowedFormats={['core/bold', 'core/italic']}
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
            allowedFormats={['core/bold', 'core/italic']}
          />
        </div>

        {/* Items */}
        <div className="space-y-4">
          <p className="text-sm font-semibold">Carousel Items</p>
          {(items ?? []).map((item, index) => (
            <div
              key={index}
              className="relative rounded-lg border border-gray-200 bg-white p-4"
            >
              <Button
                isDestructive
                variant="tertiary"
                className="absolute top-2 right-2"
                onClick={() => removeItem(index)}
              >
                ✕
              </Button>

              <p className="mb-3 text-sm font-semibold text-gray-600">
                Item {index + 1}
              </p>

              <div className="mb-3">
                <p className="mb-2 text-sm font-semibold">Stat</p>
                <RichText
                  tagName="div"
                  value={item.stat}
                  onChange={(value) => updateItem(index, 'stat', value)}
                  placeholder="e.g. 19%"
                  allowedFormats={['core/bold', 'core/italic']}
                />
              </div>

              <div>
                <p className="mb-2 text-sm font-semibold">Description</p>
                <RichText
                  tagName="div"
                  value={item.description}
                  onChange={(value) => updateItem(index, 'description', value)}
                  placeholder="e.g. Reduction in Indiana's statewide overdose death rate"
                  allowedFormats={['core/bold', 'core/italic']}
                />
              </div>
            </div>
          ))}

          <Button variant="secondary" onClick={addItem}>
            + Add item
          </Button>
        </div>
      </div>
    );
  },
  save: () => null,
});
