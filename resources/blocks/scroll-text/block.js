document.addEventListener("DOMContentLoaded", function () {
  var blocks = document.querySelectorAll(".scroll-text-block");

  blocks.forEach(function (block) {
    var content = block.querySelector(".scroll-text-content");
    if (!content) return;

    wrapWords(content);

    var words = content.querySelectorAll(".scroll-word");
    var totalWords = words.length;
    if (!totalWords) return;

    function update() {
      var rect = block.getBoundingClientRect();
      var vh = window.innerHeight;

      var start = vh * 0.4;
      var end = vh * 0.05;
      var progress = (start - rect.top) / (start - end);
      progress = Math.max(0, Math.min(1, progress));

      for (var i = 0; i < totalWords; i++) {
        var threshold = (i / totalWords) * 0.9 + 0.05;
        words[i].setAttribute(
          "data-revealed",
          progress > threshold ? "true" : "false",
        );
      }
    }

    window.addEventListener("scroll", update, { passive: true });
    update();
  });
});

function wrapWords(element) {
  var walker = document.createTreeWalker(element, NodeFilter.SHOW_TEXT, null);
  var textNodes = [];

  while (walker.nextNode()) {
    textNodes.push(walker.currentNode);
  }

  textNodes.forEach(function (node) {
    var text = node.textContent;
    if (!text.trim()) return;

    var fragment = document.createDocumentFragment();
    var parts = text.split(/(\s+)/);

    parts.forEach(function (part) {
      if (/^\s+$/.test(part)) {
        fragment.appendChild(document.createTextNode(part));
      } else if (part) {
        var span = document.createElement("span");
        span.className = "scroll-word";
        span.textContent = part;
        fragment.appendChild(span);
      }
    });

    node.parentNode.replaceChild(fragment, node);
  });
}
