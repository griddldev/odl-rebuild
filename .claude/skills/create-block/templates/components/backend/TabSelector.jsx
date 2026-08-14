import { Button } from '@wordpress/components';

/**
 * Tabbed selector for editing items of an array attribute one at a time.
 * Prevents the editor from growing infinitely downward and keeps the UI
 * compact when blocks have many items.
 *
 * Pair with `useState(0)` for active index. Render the per-item edit
 * form below this component, scoped to `items[activeItem]`.
 *
 * @param {object}   props
 * @param {Array}    props.items - The array attribute (whatever shape).
 * @param {number}   props.activeItem - Currently active item index.
 * @param {Function} props.setActiveItem - Setter for the active index.
 * @param {Function} props.addItem - Callback to append a new item.
 * @param {string}   [props.addButtonLabel] - Label for the add button.
 * @param {string}   [props.itemLabelPrefix] - Prefix for each tab label.
 */
export function TabSelector({
  items,
  activeItem,
  setActiveItem,
  addItem,
  addButtonLabel = '+ Add Item',
  itemLabelPrefix = 'Item',
}) {
  return (
    <div className="mb-6 flex flex-wrap gap-2 border-b border-gray-200 pb-4">
      {items.map((_, index) => (
        <button
          key={index}
          type="button"
          className={`rounded-t-lg px-4 py-2 text-sm font-medium transition-all ${
            activeItem === index
              ? 'bg-gray-800 text-white shadow-md'
              : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
          }`}
          onClick={() => setActiveItem(index)}
        >
          {itemLabelPrefix} {index + 1}
        </button>
      ))}
      <Button
        variant="secondary"
        onClick={addItem}
        className="ml-auto border border-gray-300 bg-white text-gray-800 hover:bg-gray-50"
      >
        {addButtonLabel}
      </Button>
    </div>
  );
}
