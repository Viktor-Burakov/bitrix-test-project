$(document).ready(function () {
   let fieldId = 1;
   let wrapper = ".app-rows";
   let fieldClone = $("#app-item_0").clone(true, true);
   let fieldNames = ["expenses", "price", "purpose", "note"];

   $(fieldClone)
      .find(".btn-plus")
      .addClass("btn-danger btn-del")
      .removeClass("btn-dark btn-plus");

   $(".btn-plus").click(function () {
      let field = $(fieldClone).clone(true, true);

      $.each(fieldNames, function (index, value) {
         $(field)
            .find('[id^="' + value + '_"]')
            .attr("name", "app_item[" + fieldId + "][" + value + "]")
            .attr("id", value + "_" + fieldId);

         $(field)
            .find('label[for^="' + value + '_"]')
            .attr("for", value + "_" + fieldId);
      });

      $(field)
         .attr("id", "app-item_" + fieldId)
         .appendTo(wrapper);
      fieldId++;
   });

   $(wrapper).on("click", ".btn-del", function () {
      $(this).closest(".app-item").remove();
   });

   (function () {
      "use strict";
      var forms = document.querySelectorAll(".needs-validation");

      Array.prototype.slice.call(forms).forEach(function (form) {
         form.addEventListener(
            "submit",
            function (event) {
               if (!form.checkValidity()) {
                  event.preventDefault();
                  event.stopPropagation();
               }

               form.classList.add("was-validated");
            },
            false
         );
      });
   })();
});
