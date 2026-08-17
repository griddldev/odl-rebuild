import { Button } from '@wordpress/components';
import { useState } from '@wordpress/element';

export function ImageUploadWithHover({
  MediaUpload,
  imageUrl,
  imageId,
  onSelect,
  onRemove,
  height = 200,
}) {
  const [isHovered, setIsHovered] = useState(false);

  if (imageUrl) {
    return (
      <div
        className="relative overflow-hidden rounded-lg"
        style={{ height }}
        onMouseEnter={() => setIsHovered(true)}
        onMouseLeave={() => setIsHovered(false)}
      >
        <img src={imageUrl} alt="" className="h-full w-full object-cover" />
        {isHovered && (
          <div className="absolute inset-0 flex items-center justify-center gap-2 bg-black/50">
            <MediaUpload
              onSelect={onSelect}
              allowedTypes={['image']}
              value={imageId}
              render={({ open }) => (
                <Button variant="secondary" onClick={open}>
                  Replace
                </Button>
              )}
            />
            <Button isDestructive variant="secondary" onClick={onRemove}>
              Remove
            </Button>
          </div>
        )}
      </div>
    );
  }

  return (
    <MediaUpload
      onSelect={onSelect}
      allowedTypes={['image']}
      value={imageId}
      render={({ open }) => (
        <div
          className="flex cursor-pointer items-center justify-center rounded-lg border-2 border-dashed border-gray-300 hover:border-gray-400"
          style={{ height }}
          onClick={open}
          onKeyDown={(e) => e.key === 'Enter' && open()}
          role="button"
          tabIndex={0}
        >
          <span className="text-gray-500">Click to upload image</span>
        </div>
      )}
    />
  );
}
