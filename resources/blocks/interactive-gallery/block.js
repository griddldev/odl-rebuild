document.addEventListener("DOMContentLoaded", function () {
  var MOBILE_BREAKPOINT = 1024;
  var blocks = document.querySelectorAll(".interactive-gallery-block");

  blocks.forEach(function (block) {
    var grid = block.querySelector(".gallery-grid");
    var items = block.querySelectorAll(".gallery-item");
    var titles = block.querySelectorAll(".gallery-title");
    var descriptions = block.querySelectorAll(".gallery-description");

    if (!grid) return;

    var currentIndex = -1;
    var transitioning = false;
    var FADE_DURATION = 250;

    function isMobile() {
      return window.innerWidth < MOBILE_BREAKPOINT;
    }

    function updateSlidePosition(index) {
      if (!isMobile()) return;
      items.forEach(function (item) {
        item.style.transform = "translateX(-" + index * 100 + "%)";
      });
    }

    function clearSlidePosition() {
      items.forEach(function (item) {
        item.style.transform = "";
      });
    }

    function setActive(index, animate) {
      grid.setAttribute("data-active", index);

      items.forEach(function (item, i) {
        item.classList.toggle("active", i === index);
      });

      var activeItem = items[index];
      if (activeItem && activeItem.dataset.activeColor) {
        block.style.backgroundColor = activeItem.dataset.activeColor;
      }

      updateSlidePosition(index);

      if (!animate || currentIndex === index) {
        titles.forEach(function (title, i) {
          title.classList.toggle("active", i === index);
        });
        descriptions.forEach(function (desc, i) {
          desc.classList.toggle("active", i === index);
        });
        currentIndex = index;
        return;
      }

      transitioning = true;

      titles.forEach(function (title) {
        title.classList.remove("active");
      });
      descriptions.forEach(function (desc) {
        desc.classList.remove("active");
      });

      setTimeout(function () {
        titles.forEach(function (title, i) {
          title.classList.toggle("active", i === index);
        });
        descriptions.forEach(function (desc, i) {
          desc.classList.toggle("active", i === index);
        });
        currentIndex = index;
        transitioning = false;
      }, FADE_DURATION);
    }

    items.forEach(function (item, i) {
      item.addEventListener("click", function () {
        if (transitioning) return;
        setActive(i, true);
      });
    });

    var prevBtn = block.querySelector(".gallery-prev");
    var nextBtn = block.querySelector(".gallery-next");
    var totalItems = items.length;

    if (prevBtn) {
      prevBtn.addEventListener("click", function () {
        if (transitioning) return;
        var newIndex = (currentIndex - 1 + totalItems) % totalItems;
        setActive(newIndex, true);
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener("click", function () {
        if (transitioning) return;
        var newIndex = (currentIndex + 1) % totalItems;
        setActive(newIndex, true);
      });
    }

    window.addEventListener("resize", function () {
      if (isMobile()) {
        updateSlidePosition(currentIndex);
      } else {
        clearSlidePosition();
      }
    });

    setActive(0, false);
  });
});
