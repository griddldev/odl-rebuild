import { registerBlockType } from '@wordpress/blocks';
import {
  useBlockProps,
  RichText,
  MediaUpload,
  MediaUploadCheck,
} from '@wordpress/block-editor';
import { TextControl, Button } from '@wordpress/components';
import { ImageUploadWithHover } from '../components/ImageUploadWithHover.jsx';

registerBlockType('sage/interactive-gallery', {
  edit: ({ attributes, setAttributes }) => {
    const { heading, items } = attributes;
    const blockProps = useBlockProps();

    const updateItem = (index, field, value) => {
      const updated = [...(items ?? [])];
      updated[index] = { ...updated[index], [field]: value };
      setAttributes({ items: updated });
    };

    const updateItemMany = (index, data) => {
      const updated = [...(items ?? [])];
      updated[index] = { ...updated[index], ...data };
      setAttributes({ items: updated });
    };

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
            allowedFormats={['core/bold', 'core/italic']}
          />
        </div>

        {/* 3 fixed items */}
        <div className="space-y-6">
          <p className="text-sm font-semibold">Items (3 fixed)</p>
          {(items ?? []).map((item, index) => (
            <div
              key={index}
              className="rounded-lg border border-gray-200 bg-white p-4"
            >
              <p className="mb-3 text-sm font-semibold text-gray-600">
                Item {index + 1}
              </p>

              {/* Image */}
              <div className="mb-4">
                <MediaUploadCheck>
                  <ImageUploadWithHover
                    MediaUpload={MediaUpload}
                    imageUrl={item.imageUrl}
                    imageId={item.imageId}
                    onSelect={(media) =>
                      updateItemMany(index, {
                        imageUrl: media?.url || '',
                        imageId: media?.id ?? null,
                        imageAlt: media?.alt ?? '',
                      })
                    }
                    onRemove={() =>
                      updateItemMany(index, {
                        imageUrl: '',
                        imageId: null,
                        imageAlt: '',
                      })
                    }
                    height={160}
                  />
                </MediaUploadCheck>
              </div>

              {/* Title */}
              <div className="mb-3">
                <TextControl
                  label="Title"
                  value={item.title}
                  onChange={(value) => updateItem(index, 'title', value)}
                  placeholder="Enter item title..."
                />
              </div>

              {/* Description */}
              <div>
                <p className="mb-2 text-sm font-semibold">Description</p>
                <RichText
                  tagName="div"
                  value={item.description}
                  onChange={(value) => updateItem(index, 'description', value)}
                  placeholder="Enter item description..."
                  allowedFormats={['core/bold', 'core/italic']}
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
