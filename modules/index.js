/*toggle sub menus*/
$(document).ready(function () {
  $('.sub-btn').on("click", function () {
    $(this).next('.sub-menu').slideToggle();
  });
});



function pathToggleActive() {
  const breadcrumb = $(".breadcrumb");
  $(breadcrumb).children().last().addClass("active");
  console.log($(breadcrumb).children().last());

}
pathToggleActive();

$("#deleteModal").on("show.bs.modal", showDeleteModal)

function showDeleteModal(e) {
  const url = $(e.relatedTarget).data("url");
  console.log(url);
  $("#deleteForm").append(`
      <input type="hidden" name="url" value="${url}">
  `)
}

$("#modalEdit").on("show.bs.modal", showEditModal)

function showEditModal(e) {
  const url = $(e.relatedTarget).data("url");
  console.log(url);
  $("#edit_form").append(`
      <input type="hidden" name="oldName" value="${url}">
  `)
}

$("#searchBtn").on("click", function () {
  console.log("hola");
})



if ($(".closing").length) {
  $(".closing").each(function (idx, element) {
    $(element).on("click", closeclose)
  })


}

function closeclose() {
  window.location.replace("./index.php");
}
