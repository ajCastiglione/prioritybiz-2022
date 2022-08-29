export default function Forms($) {
  $(document).on("gform_confirmation_loaded", function (event, formId) {
    $("h2, p").remove();
    $(".entry-content").css("padding", "100px 0");
  });
}
