var path = "";

document.oncontextmenu = function () {
  return false;
};

$(document).mousedown(function (e) {
  path = e.target.dataset.dir;
  updateTmpPath(path);
  if (e.button === 2) {
    $(".rightClick").removeClass("showing");
    var n = $(".rightClick").clone(true);
    $(".rightClick").fadeOut(100);
    setTimeout(function () {
      $(".rightClick")
        .css({
          top: e.pageY - 100,
          left: e.pageX - 100,
        })
        .fadeIn(100)
        .addClass("showing");
    }, 200);
  } else if (e.button === 0) {
    setTimeout(function () {
      $(".rightClick").removeClass("showing").fadeOut(100);
    }, 150);
  }
});
$(".rightClick .overlap").click(function () {
  // history.back(1); // To go back
  $(".showVal1").text("Back Button Pressed");
});
$(".rightClick .new").click(function () {
  $(".showVal1").text("New Button Pressed");
});
$(".rightClick .edit").click(function () {
  $(".showVal1").text("Edit Button Pressed");
});
$(".rightClick .help").click(function () {
  $(".showVal1").text("Help Button Pressed");
});

function updateTmpPath(path) {
  if (path) {
    $.ajax({
      type: "POST",
      url: "fileControll/session.php",
      data: { path: path, tmpPath: "yes" },
      success: function (response) {
        // $(".header-test").html(response);
      },
    });
  }
}
