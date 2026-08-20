document.addEventListener('DOMContentLoaded', function () {
  var blocks = document.querySelectorAll('.interactive-gallery-block');

  blocks.forEach(function (block) {
    var grid = block.querySelector('.gallery-grid');
    var items = block.querySelectorAll('.gallery-item');
    var titles = block.querySelectorAll('.gallery-title');
    var descriptions = block.querySelectorAll('.gallery-description');

    if (!grid) return;

    var currentIndex = -1;
    var transitioning = false;
    var FADE_DURATION = 250;

    function setActive(index, animate) {
      grid.setAttribute('data-active', index);

      items.forEach(function (item, i) {
        item.classList.toggle('active', i === index);
      });

      var activeItem = items[index];
      if (activeItem && activeItem.dataset.activeColor) {
        block.style.backgroundColor = activeItem.dataset.activeColor;
      }

      if (!animate || currentIndex === index) {
        titles.forEach(function (title, i) {
          title.classList.toggle('active', i === index);
        });
        descriptions.forEach(function (desc, i) {
          desc.classList.toggle('active', i === index);
        });
        currentIndex = index;
        return;
      }

      transitioning = true;

      titles.forEach(function (title) {
        title.classList.remove('active');
      });
      descriptions.forEach(function (desc) {
        desc.classList.remove('active');
      });

      setTimeout(function () {
        titles.forEach(function (title, i) {
          title.classList.toggle('active', i === index);
        });
        descriptions.forEach(function (desc, i) {
          desc.classList.toggle('active', i === index);
        });
        currentIndex = index;
        transitioning = false;
      }, FADE_DURATION);
    }

    items.forEach(function (item, i) {
      item.addEventListener('click', function () {
        if (transitioning) return;
        setActive(i, true);
      });
    });

    setActive(0, false);
  });
});
