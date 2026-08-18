import { registerBlockType } from '@wordpress/blocks';
import {
  useBlockProps,
  RichText,
  MediaUpload,
  MediaUploadCheck,
} from '@wordpress/block-editor';
import { TextControl } from '@wordpress/components';
import { ImageUploadWithHover } from '../components/ImageUploadWithHover.jsx';

registerBlockType('sage/split-container', {
  edit: ({ attributes, setAttributes }) => {
    const {
      imageUrl,
      imageId,
      heading,
      subtitle,
      body,
      link1Text,
      link1Url,
      link2Text,
      link2Url,
    } = attributes;
    const blockProps = useBlockProps();

    return (
      <div
        {...blockProps}
        className="split-container-editor border-2 border-dashed border-teal-300 bg-teal-50 p-8"
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
            <line x1="12" y1="2" x2="12" y2="22" />
          </svg>
          <span className="text-lg font-bold">Split Container</span>
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

        {/* Heading */}
        <div className="mb-4">
          <p className="mb-2 text-sm font-semibold">Heading</p>
          <RichText
            tagName="h2"
            value={heading}
            onChange={(value) => setAttributes({ heading: value })}
            placeholder="Enter heading..."
            allowedFormats={['core/bold', 'core/italic']}
          />
        </div>

        {/* Subtitle */}
        <div className="mb-4">
          <p className="mb-2 text-sm font-semibold">Subtitle</p>
          <RichText
            tagName="div"
            value={subtitle}
            onChange={(value) => setAttributes({ subtitle: value })}
            placeholder="Enter subtitle..."
            allowedFormats={['core/bold', 'core/italic']}
          />
        </div>

        {/* Body */}
        <div className="mb-6">
          <p className="mb-2 text-sm font-semibold">Body</p>
          <RichText
            tagName="div"
            value={body}
            onChange={(value) => setAttributes({ body: value })}
            placeholder="Enter body text..."
            allowedFormats={['core/bold', 'core/italic']}
          />
        </div>

        {/* Links */}
        <div className="space-y-4">
          <p className="text-sm font-semibold">CTA Links</p>

          <div className="rounded border border-gray-100 bg-gray-50 p-3">
            <p className="mb-2 text-sm font-semibold">Link 1</p>
            <RichText
              tagName="div"
              value={link1Text}
              onChange={(value) => setAttributes({ link1Text: value })}
              placeholder="e.g. Learn More About Our Story"
              allowedFormats={['core/bold', 'core/italic']}
            />
            <TextControl
              label="URL"
              value={link1Url}
              onChange={(value) => setAttributes({ link1Url: value })}
              placeholder="https://..."
            />
          </div>

          <div className="rounded border border-gray-100 bg-gray-50 p-3">
            <p className="mb-2 text-sm font-semibold">Link 2 (optional)</p>
            <RichText
              tagName="div"
              value={link2Text}
              onChange={(value) => setAttributes({ link2Text: value })}
              placeholder="e.g. Request Justin as a Speaker"
              allowedFormats={['core/bold', 'core/italic']}
            />
            <TextControl
              label="URL"
              value={link2Url}
              onChange={(value) => setAttributes({ link2Url: value })}
              placeholder="https://..."
            />
          </div>
        </div>
      </div>
    );
  },
  save: () => null,
});
