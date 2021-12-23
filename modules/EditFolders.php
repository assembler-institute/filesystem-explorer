<?php
/*EDIT RENAME FILE*/

if (isset($_POST['edit-name'])) {
  $editPost = $_POST['edit-name'];
  print_r($editPost);
  $old_name = $_POST['oldName'];
  $arrayEdit = explode("/", $old_name);
  //remove the last position
  array_pop($arrayEdit);
  //convert to string again
  $path = implode("/", $arrayEdit);
  $new_name = "$path/" . $_POST['edit-name'];
  $name = rename("./../$old_name", "./../$new_name");
  if ($path === "./root") {
    header('Location: ./../index.php');
  } else {
    header('location:./../index.php?path=' . $path);
  };
};
