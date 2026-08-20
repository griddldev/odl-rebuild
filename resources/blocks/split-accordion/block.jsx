import { registerBlockType } from '@wordpress/blocks';
import {
  useBlockProps,
  RichText,
  MediaUpload,
  MediaUploadCheck,
} from '@wordpress/block-editor';
import { TextControl, Button } from '@wordpress/components';
import { ImageUploadWithHover } from '../components/ImageUploadWithHover.jsx';

registerBlockType('sage/split-accordion', {
  edit: ({ attributes, setAttributes }) => {
    const { heading, subtitleFaded, subtitleMain, imageUrl, imageId, items } =
      attributes;
    const blockProps = useBlockProps();

    const updateItem = (index, field, value) => {
      const updated = [...(items ?? [])];
      updated[index] = { ...updated[index], [field]: value };
      setAttributes({ items: updated });
    };

    const addItem = () => {
      const updated = [...(items ?? [])];
      updated.push({ title: '', content: '', linkText: '', linkUrl: '' });
      setAttributes({ items: updated });
    };

    const removeItem = (index) => {
      const updated = (items ?? []).filter((_, i) => i !== index);
      setAttributes({ items: updated });
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
            allowedFormats={['core/bold', 'core/italic']}
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
            allowedFormats={['core/bold', 'core/italic']}
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
            allowedFormats={['core/bold', 'core/italic']}
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
                  imageUrl: media?.url || '',
                  imageId: media?.id ?? null,
                  imageAlt: media?.alt ?? '',
                })
              }
              onRemove={() =>
                setAttributes({
                  imageUrl: '',
                  imageId: null,
                  imageAlt: '',
                })
              }
              height={200}
            />
          </MediaUploadCheck>
        </div>

        {/* Accordion items */}
        <div className="space-y-4">
          <p className="text-sm font-semibold">Accordion Items</p>
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
                <p className="mb-2 text-sm font-semibold">Title</p>
                <RichText
                  tagName="div"
                  value={item.title}
                  onChange={(value) => updateItem(index, 'title', value)}
                  placeholder="e.g. I need naloxone"
                  allowedFormats={['core/bold', 'core/italic']}
                />
              </div>

              <div className="mb-3">
                <p className="mb-2 text-sm font-semibold">Content</p>
                <RichText
                  tagName="div"
                  value={item.content}
                  onChange={(value) => updateItem(index, 'content', value)}
                  placeholder="Enter accordion content..."
                  allowedFormats={['core/bold', 'core/italic']}
                />
              </div>

              <div className="rounded border border-gray-100 bg-gray-50 p-3">
                <p className="mb-2 text-sm font-semibold">
                  CTA Button (optional)
                </p>
                <RichText
                  tagName="div"
                  value={item.linkText}
                  onChange={(value) => updateItem(index, 'linkText', value)}
                  placeholder="e.g. Get Free Naloxone"
                  allowedFormats={['core/bold', 'core/italic']}
                />
                <TextControl
                  label="URL"
                  value={item.linkUrl}
                  onChange={(value) => updateItem(index, 'linkUrl', value)}
                  placeholder="https://..."
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
