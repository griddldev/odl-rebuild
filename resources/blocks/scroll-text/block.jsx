import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps, RichText } from "@wordpress/block-editor";

registerBlockType("sage/scroll-text", {
  edit: ({ attributes, setAttributes }) => {
    const { content } = attributes;
    const blockProps = useBlockProps();

    return (
      <div
        {...blockProps}
        className="scroll-text-editor border-2 border-dashed border-amber-200 bg-amber-50 p-8"
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
            <path d="M12 3v18" />
            <path d="m8 17 4 4 4-4" />
            <path d="M4 6h16" />
            <path d="M4 10h16" />
            <path d="M4 14h16" />
          </svg>
          <span className="text-lg font-bold">Scroll Text</span>
        </div>

        <div className="mb-2">
          <p className="mb-2 text-sm font-semibold">Content</p>
          <RichText
            tagName="div"
            multiline="p"
            value={content}
            onChange={(value) => setAttributes({ content: value })}
            placeholder="Enter text that will reveal on scroll..."
            allowedFormats={["core/bold", "core/italic"]}
          />
        </div>
      </div>
    );
  },
  save: () => null,
});
