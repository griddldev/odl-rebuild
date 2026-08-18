import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { SelectControl, TextControl } from '@wordpress/components';

const COLOR_OPTIONS = [
  { label: 'Pink', value: 'pink' },
  { label: 'Teal', value: 'teal' },
  { label: 'Blue', value: 'blue' },
  { label: 'Yellow', value: 'yellow' },
  { label: 'Off White', value: 'off-white' },
];

registerBlockType('sage/card-grid', {
  edit: ({ attributes, setAttributes }) => {
    const { heading, subtitle, body, cards } = attributes;
    const blockProps = useBlockProps();

    const updateCard = (index, field, value) => {
      const updated = [...(cards ?? [])];
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
            allowedFormats={['core/bold', 'core/italic']}
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
            allowedFormats={['core/bold', 'core/italic']}
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
            allowedFormats={['core/bold', 'core/italic']}
          />
        </div>

        {/* Cards */}
        <div className="space-y-6">
          <p className="text-sm font-semibold">Cards (4 fixed)</p>
          {(cards ?? []).map((card, index) => (
            <div
              key={index}
              className="rounded-lg border border-gray-200 bg-white p-4"
            >
              <p className="mb-3 text-sm font-semibold text-gray-600">
                Card {index + 1}
              </p>

              <div className="mb-3">
                <SelectControl
                  label="Background Color"
                  value={card.backgroundColor}
                  options={COLOR_OPTIONS}
                  onChange={(value) =>
                    updateCard(index, 'backgroundColor', value)
                  }
                />
              </div>

              <div className="mb-3">
                <p className="mb-2 text-sm font-semibold">Title</p>
                <RichText
                  tagName="div"
                  value={card.title}
                  onChange={(value) => updateCard(index, 'title', value)}
                  placeholder="e.g. Donate"
                  allowedFormats={['core/bold', 'core/italic']}
                />
              </div>

              <div className="mb-3">
                <p className="mb-2 text-sm font-semibold">Subtitle</p>
                <RichText
                  tagName="div"
                  value={card.subtitle}
                  onChange={(value) => updateCard(index, 'subtitle', value)}
                  placeholder="Enter card subtitle..."
                  allowedFormats={['core/bold', 'core/italic']}
                />
              </div>

              <div className="mb-3">
                <p className="mb-2 text-sm font-semibold">Body</p>
                <RichText
                  tagName="div"
                  value={card.body}
                  onChange={(value) => updateCard(index, 'body', value)}
                  placeholder="Enter card body text..."
                  allowedFormats={['core/bold', 'core/italic']}
                />
              </div>

              <div className="rounded border border-gray-100 bg-gray-50 p-3">
                <p className="mb-2 text-sm font-semibold">CTA Link</p>
                <RichText
                  tagName="div"
                  value={card.linkText}
                  onChange={(value) => updateCard(index, 'linkText', value)}
                  placeholder="e.g. Donate Now"
                  allowedFormats={['core/bold', 'core/italic']}
                />
                <TextControl
                  label="URL"
                  value={card.linkUrl}
                  onChange={(value) => updateCard(index, 'linkUrl', value)}
                  placeholder="https://..."
                />
              </div>
            </div>
          ))}
        </div>
      </div>
    );
  },
  save: () => null,
});
