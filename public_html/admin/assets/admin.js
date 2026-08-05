(function () {
  "use strict";

  function nextIndex(fieldset) {
    var n = parseInt(fieldset.getAttribute("data-next-index") || "", 10);
    if (isNaN(n)) {
      n = fieldset.querySelectorAll(":scope > .f-list-items > .f-list-item").length;
    }
    fieldset.setAttribute("data-next-index", String(n + 1));
    return n;
  }

  document.addEventListener("click", function (e) {
    var add = e.target.closest(".f-add");
    if (add) {
      var fieldset = add.closest(".f-list");
      var tpl = fieldset.querySelector(".f-list-template");
      var itemsWrap = fieldset.querySelector(".f-list-items");
      var idx = nextIndex(fieldset);
      var html = tpl.innerHTML.split("__INDEX__").join(String(idx));
      var wrap = document.createElement("div");
      wrap.innerHTML = html.trim();
      itemsWrap.appendChild(wrap.firstElementChild);
      return;
    }
    var remove = e.target.closest(".f-remove");
    if (remove) {
      var item = remove.closest(".f-list-item");
      if (item) item.remove();
      return;
    }
  });

  // Instant local preview when a new image file is chosen.
  document.addEventListener("change", function (e) {
    var input = e.target.closest('input[type="file"]');
    if (!input) return;
    var file = input.files && input.files[0];
    if (!file) return;
    var row = input.closest(".f-image-row");
    var thumb = row && row.querySelector(".f-thumb");
    if (!thumb) return;
    var url = URL.createObjectURL(file);
    if (thumb.tagName === "IMG") {
      thumb.src = url;
    } else {
      var img = document.createElement("img");
      img.className = "f-thumb";
      img.src = url;
      thumb.replaceWith(img);
    }
  });
})();
