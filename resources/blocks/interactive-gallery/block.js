document.addEventListener('DOMContentLoaded', function () {
  var blocks = document.querySelectorAll('.interactive-gallery-block');

  blocks.forEach(function (block) {
    var grid = block.querySelector('.gallery-grid');
    var items = block.querySelectorAll('.gallery-item');
    var titles = block.querySelectorAll('.gallery-title');
    var descriptions = block.querySelectorAll('.gallery-description');

    if (!grid) return;

    function setActive(index) {
      grid.setAttribute('data-active', index);

      items.forEach(function (item, i) {
        item.classList.toggle('active', i === index);
      });

      titles.forEach(function (title, i) {
        title.classList.toggle('active', i === index);
      });

      descriptions.forEach(function (desc, i) {
        desc.classList.toggle('active', i === index);
      });
    }

    items.forEach(function (item, i) {
      item.addEventListener('click', function () {
        setActive(i);
      });
    });

    setActive(0);
  });
});
