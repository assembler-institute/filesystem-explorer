<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



  <title>File System</title>
</head>

<body>
  <?php include "./header.php"; ?>


  <main class="m-5">
    <div class="row">
      <div class="col-sm-2 box rounded p-2">
        <?php include "./sidebar.php"; ?>
      </div>
      <div class="col-sm-10 box rounded p-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Add file
        </button>

        <div id="fileDataTable" class="table-responsive"></div>
      </div>

    </div>
  </main>
  <?php include "./footer.php"; ?>
  <!-- Modal -->
  <?php include "./modal.php"; ?>

  <!-- JavaScript -->
  <script src="../../app/js/loadTable.js"></script>
  <script src="../../app/js/loadSidebar.js"></script>
  <script src="../../app/js/ajaxCreateFolder.js"></script>
  <script src="../../app/js/ajaxGetCurrentFolder.js"></script>
  <script src="../../app/js/ajaxRename.js"></script>
  <script src="../../app/js/ajaxDelete.js"></script>
  <script src="../../app/js/ajaxUpload.js"></script>
  <script src="../../app/js/ajaxOpenFile.js"></script>


</body>

</html>