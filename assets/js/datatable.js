$(document).ready(function () {
  $("#table").DataTable({
    searching: false,
    columnDefs: [
      { orderable: false, targets: 3 },
      { orderable: false, targets: 4 },
      { orderable: false, targets: 5 },
    ],
  });
  $("#tree").jstree();
});
