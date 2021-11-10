<?php
include_once "./includes/search.inc.php";
include_once "./includes/icons.inc.php";



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <title>File System Project </title>
</head>

<body>

    <header class="d-flex justify-content-between align-items-center p-4">

        <h5><a href="index.php"><i class="fas fa-home"></i></a><?= "  Search results: " . $_GET["search"] . "</br>" ?></h5>

        <div class="d-flex m-6 align-items-center">
            <form action="./includes/search.inc.php" class="me-4">
                <input type="search" placeholder="&#x1F50E;&#xFE0E;">
            </form>

            <!-- Button trigger modal -->
            <button name="addNew" class="btn btn-dark rounded-circle" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i></button>
            <!-- Button trigger modal -->
            <button name="addFolder" class="btn btn-dark rounded-circle" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i class="fas fa-folder-plus"></i></button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add file</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="./includes/addfile.php?directory=root" enctype="multipart/form-data">
                                <input type="file" name="addfile" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button name="btn-menu" type="submit" class="btn btn-primary">Add file</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal2 -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add folder</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="./includes/addfolder.inc.php?directory=root">
                                <input type=" text" name="addfolder" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button name="btn-menu" type="submit" class="btn btn-primary">Add file</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </header>


    <main id="page-content ">
        <table class="table">
            <thead>
                <tr class="table-info">
                    <th>Name</th>
                    <th>Size</th>
                    <th>Modified</th>
                    <th>Creation </th>
                    <th>Extension</th>
                    <th>Actions</th>
                </tr>
            </thead>


            <tbody>
                <?php if (!empty($fileFetched)) : ?>
                    <?php
                    foreach ($fileFetched as $file) :
                    ?>
                        <tr>
                            <td>
                                <?php if ($file["edit"]) : ?>
                                    <form action="
                ./includes/edittitle.inc.php?directory=<?= $file["path"]; ?>&id=<?= $file["id"]; ?>&name=<?= $file["name"]; ?>&extension=<?= $file["extension"]; ?>" method="POST">
                                        <input type="text" name="title" value=<?php echo $file["name"] ?>>
                                        <input type="submit" name="change" value="change">
                                    </form>
                                <?php else : ?>
                                    <i class="<?= getFileType($file['extension']); ?>"></i>
                                    <a href="includes/openfile.inc.php?path=<?= $file["path"]; ?>&extension=<?= $file["extension"]; ?>"><?php echo $file["name"] ?></a>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $file["size"] ?></td>
                            <td><?php echo $file["modified"] ?></td>
                            <td><?php echo $file["creation"] ?></td>
                            <td><?php echo $file["extension"] ?></td>

                            <td>
                                <button onClick="document.location.href='includes/edit.inc.php?id=<?= $file['id']; ?>&daddyPath=<?= $file['daddyPath']; ?>'" class="btn btn-warning"><i class="far fa-edit"></i></button>
                                <button onClick="document.location.href='includes/delete.inc.php?id=<?= $file['id']; ?>&path=<?= $file["path"]; ?>'" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>
    </main>
    <footer id=" sticky-footer" class="footer mt-auto py-3 bg-light fixed-bottom">
        <div class="container text-center">
            <small>TOP Team © All Rights Reserved 2021 Your Website</small>
        </div>
    </footer>

</body>

</html>