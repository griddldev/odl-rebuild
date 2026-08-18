import { registerBlockType } from '@wordpress/blocks';
import {
  useBlockProps,
  MediaUpload,
  MediaUploadCheck,
  RichText,
} from '@wordpress/block-editor';
import { TextControl, Button } from '@wordpress/components';
import { ImageUploadWithHover } from '../components/ImageUploadWithHover.jsx';

registerBlockType('sage/hero', {
  edit: ({ attributes, setAttributes }) => {
    const {
      heading,
      backgroundImageUrl,
      backgroundImageId,
      videoUrl,
      videoId,
      link1Label,
      link1Url,
      link2Label,
      link2Url,
      link3Label,
      link3Url,
    } = attributes;

    const blockProps = useBlockProps();

    return (
      <div
        {...blockProps}
        className="hero-editor border-2 border-dashed border-indigo-200 bg-indigo-50 p-8"
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
            <rect x="2" y="3" width="20" height="14" rx="2" />
            <path d="M8 21h8" />
            <path d="M12 17v4" />
            <path d="m10 9 5 3-5 3V9z" />
          </svg>
          <span className="text-lg font-bold">Hero</span>
        </div>

        {/* Heading */}
        <div className="mb-6">
          <p className="mb-2 text-sm font-semibold">Heading</p>
          <RichText
            tagName="h2"
            value={heading}
            onChange={(value) => setAttributes({ heading: value })}
            placeholder="Enter hero heading..."
            allowedFormats={['core/bold', 'core/italic']}
          />
        </div>

        {/* Background Image (poster) */}
        <div className="mb-6">
          <p className="mb-2 text-sm font-semibold">
            Background Image (video poster / fallback)
          </p>
          <MediaUploadCheck>
            <ImageUploadWithHover
              MediaUpload={MediaUpload}
              imageUrl={backgroundImageUrl}
              imageId={backgroundImageId}
              onSelect={(media) =>
                setAttributes({
                  backgroundImageUrl: media?.url || '',
                  backgroundImageId: media?.id ?? null,
                  backgroundImageAlt: media?.alt ?? '',
                })
              }
              onRemove={() =>
                setAttributes({
                  backgroundImageUrl: '',
                  backgroundImageId: null,
                  backgroundImageAlt: '',
                })
              }
              height={200}
            />
          </MediaUploadCheck>
        </div>

        {/* Background Video */}
        <div className="mb-6">
          <p className="mb-2 text-sm font-semibold">Background Video</p>
          {videoUrl ? (
            <div
              className="relative overflow-hidden rounded-lg bg-black"
              style={{ height: 160 }}
            >
              <video
                src={videoUrl}
                className="h-full w-full object-cover"
                muted
              />
              <div className="absolute inset-0 flex items-center justify-center bg-black/40">
                <Button
                  isDestructive
                  variant="secondary"
                  onClick={() => setAttributes({ videoUrl: '', videoId: null })}
                >
                  Remove video
                </Button>
              </div>
            </div>
          ) : (
            <MediaUploadCheck>
              <MediaUpload
                onSelect={(media) =>
                  setAttributes({
                    videoUrl: media?.url || '',
                    videoId: media?.id ?? null,
                  })
                }
                allowedTypes={['video']}
                value={videoId}
                render={({ open }) => (
                  <div
                    className="flex cursor-pointer items-center justify-center rounded-lg border-2 border-dashed border-gray-300 hover:border-gray-400"
                    style={{ height: 120 }}
                    onClick={open}
                    onKeyDown={(e) => e.key === 'Enter' && open()}
                    role="button"
                    tabIndex={0}
                  >
                    <span className="text-gray-500">Click to upload video</span>
                  </div>
                )}
              />
            </MediaUploadCheck>
          )}
        </div>

        {/* Navigation Links */}
        <div className="space-y-4">
          <p className="text-sm font-semibold">Navigation Links (3 fixed)</p>
          {[
            { label: link1Label, url: link1Url, prefix: 'link1', n: 1 },
            { label: link2Label, url: link2Url, prefix: 'link2', n: 2 },
            { label: link3Label, url: link3Url, prefix: 'link3', n: 3 },
          ].map((link) => (
            <div
              key={link.prefix}
              className="flex gap-3 rounded-lg border border-gray-200 bg-white p-3"
            >
              <div className="flex-1">
                <p className="mb-2 text-sm font-semibold">Label {link.n}</p>
                <RichText
                  tagName="div"
                  value={link.label}
                  onChange={(value) =>
                    setAttributes({ [`${link.prefix}Label`]: value })
                  }
                  placeholder={`Enter label ${link.n}...`}
                  allowedFormats={['core/bold', 'core/italic']}
                />
              </div>
              <TextControl
                label="URL"
                value={link.url}
                onChange={(value) =>
                  setAttributes({ [`${link.prefix}Url`]: value })
                }
                className="flex-1"
              />
            </div>
          ))}
        </div>
      </div>
    );
  },
  save: () => null,
});
