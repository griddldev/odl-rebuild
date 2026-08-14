import { SelectControl } from '@wordpress/components';

/**
 * Reusable icon selector with live SVG image preview.
 *
 * Icons ship as static SVGs under the theme's `public/icons/` directory
 * (served as-is, same mechanism Vite uses for other static assets) — adjust
 * `THEME_SLUG` below to the project's actual theme folder name.
 *
 * @param {object} props
 * @param {string} props.label - Select control label
 * @param {string} props.value - Currently selected icon value (matches an SVG filename, no extension)
 * @param {Array} props.options - List of option objects { label, value }
 * @param {function} props.onChange - Callback triggered on icon change
 * @param {string} [props.iconFolder] - Subfolder inside `public/icons/` this icon set lives in (e.g. 'chakras'); omit for icons directly under `public/icons/`
 */
const THEME_SLUG = 'sage';

export function IconPicker({
  label,
  value,
  options,
  onChange,
  iconFolder = '',
}) {
  const folderPath = iconFolder ? `${iconFolder}/` : '';
  const iconUrl = `/wp-content/themes/${THEME_SLUG}/public/icons/${folderPath}${value}.svg`;

  return (
    <div className="flex items-end gap-4">
      <div className="flex-1">
        <SelectControl
          label={label}
          value={value}
          options={options}
          onChange={onChange}
        />
      </div>
      <div className="mb-1 flex h-12 w-12 shrink-0 items-center justify-center rounded-lg border border-gray-200 bg-gray-50 p-2 text-gray-600">
        <img
          src={iconUrl}
          alt="Icon Preview"
          className="h-full w-full object-contain"
          onError={(e) => {
            e.target.style.display = 'none';
          }}
        />
      </div>
    </div>
  );
}
