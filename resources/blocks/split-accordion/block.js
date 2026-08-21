document.addEventListener("DOMContentLoaded", function () {
  var sections = document.querySelectorAll(".split-accordion-block");

  sections.forEach(function (section) {
    var triggers = section.querySelectorAll(".accordion-trigger");

    triggers.forEach(function (trigger) {
      trigger.addEventListener("click", function () {
        var item = trigger.closest(".accordion-item");
        var isOpen = item.classList.contains("is-open");

        // Close all items in this section
        section.querySelectorAll(".accordion-item").forEach(function (el) {
          el.classList.remove("is-open");
          el.querySelector(".accordion-panel").style.maxHeight = null;
          el.querySelector(".accordion-trigger").setAttribute(
            "aria-expanded",
            "false",
          );
        });

        // Toggle clicked item
        if (!isOpen) {
          item.classList.add("is-open");
          var panel = item.querySelector(".accordion-panel");
          panel.style.maxHeight = panel.scrollHeight + "px";
          trigger.setAttribute("aria-expanded", "true");
        }
      });
    });

    // Chevron arrow spread animation
    var chevronGroups = section.querySelectorAll(".chevron-group");
    if (chevronGroups.length) {
      var observer = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add("is-spread");
              observer.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.5 },
      );
      chevronGroups.forEach(function (group) {
        observer.observe(group);
      });
    }

    // Open first item by default
    var firstItem = section.querySelector(".accordion-item");
    if (firstItem) {
      firstItem.classList.add("is-open");
      var firstPanel = firstItem.querySelector(".accordion-panel");
      firstPanel.style.maxHeight = firstPanel.scrollHeight + "px";
      firstItem
        .querySelector(".accordion-trigger")
        .setAttribute("aria-expanded", "true");
    }
  });
});
