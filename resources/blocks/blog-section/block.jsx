import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps } from "@wordpress/block-editor";
import { TextControl } from "@wordpress/components";
import { LinkPicker } from "../components/backend/LinkPicker.jsx";

registerBlockType("sage/blog-section", {
  edit: ({ attributes, setAttributes }) => {
    const { title, featuredCategorySlug, allBlogsLink } = attributes;
    const blockProps = useBlockProps({ style: { marginBottom: "10px" } });

    return (
      <div
        {...blockProps}
        className="blog-section-editor border-2 border-dashed border-red-200 bg-red-50 p-8"
      >
        <div className="mb-6 flex items-center gap-3">
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
            <path d="M12 20h9" />
            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
          </svg>
          <strong className="text-lg">Blog Section</strong>
        </div>

        <div className="grid grid-cols-2 gap-6">
          <div>
            <TextControl
              label="Section Title"
              value={title}
              onChange={(val) => setAttributes({ title: val })}
            />
            <TextControl
              label="Featured Category Slug"
              help="Slug of the category used to pull the featured post"
              value={featuredCategorySlug}
              onChange={(val) => setAttributes({ featuredCategorySlug: val })}
            />
          </div>
          <div>
            <p className="mb-2 text-sm font-medium">"See All Blogs" Link</p>
            <LinkPicker
              value={allBlogsLink}
              onChange={(value) => setAttributes({ allBlogsLink: value })}
              settings={[{ id: "opensInNewTab", title: "Open in new tab" }]}
            />
          </div>
        </div>

        <div className="mt-6 rounded border border-gray-200 bg-white p-4">
          <p className="text-sm text-gray-500 italic">
            Preview: The featured post (from category "
            <strong>{featuredCategorySlug}</strong>") will appear at the top,
            followed by 3 latest posts in a card grid.
          </p>
        </div>
      </div>
    );
  },
  save: () => null,
});
