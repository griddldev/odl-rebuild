import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { SelectControl, TextControl } from '@wordpress/components';

const COLOR_OPTIONS = [
  { label: 'Blue', value: 'blue' },
  { label: 'Yellow', value: 'yellow' },
  { label: 'Pink', value: 'pink' },
  { label: 'Teal', value: 'teal' },
  { label: 'Off White', value: 'off-white' },
];

registerBlockType('sage/colored-cards', {
  edit: ({ attributes, setAttributes }) => {
    const { heading, description, cards } = attributes;
    const blockProps = useBlockProps();

    const updateCard = (index, field, value) => {
      const updated = [...(cards ?? [])];
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
            allowedFormats={['core/bold', 'core/italic']}
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
            allowedFormats={['core/bold', 'core/italic']}
          />
        </div>

        {/* Cards */}
        <div className="space-y-6">
          <p className="text-sm font-semibold">Cards (3 fixed)</p>
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
                  placeholder="e.g. Educate"
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

              <div className="mb-3 rounded border border-gray-100 bg-gray-50 p-3">
                <p className="mb-2 text-sm font-semibold">Link 1</p>
                <RichText
                  tagName="div"
                  value={card.link1Text}
                  onChange={(value) => updateCard(index, 'link1Text', value)}
                  placeholder="e.g. Explore Youth Programs"
                  allowedFormats={['core/bold', 'core/italic']}
                />
                <TextControl
                  label="URL"
                  value={card.link1Url}
                  onChange={(value) => updateCard(index, 'link1Url', value)}
                  placeholder="https://..."
                />
              </div>

              <div className="rounded border border-gray-100 bg-gray-50 p-3">
                <p className="mb-2 text-sm font-semibold">Link 2 (optional)</p>
                <RichText
                  tagName="div"
                  value={card.link2Text}
                  onChange={(value) => updateCard(index, 'link2Text', value)}
                  placeholder="e.g. Explore Training & Courses"
                  allowedFormats={['core/bold', 'core/italic']}
                />
                <TextControl
                  label="URL"
                  value={card.link2Url}
                  onChange={(value) => updateCard(index, 'link2Url', value)}
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
