<nav class="navbar navbar-dark navbar-expand-sm  justify-content-between" style="background-color: #1c2331;">

    <div class="container d-flex justify-content-evenly">
        <div class="col-lg-2 logo col-xs-12">
            <a href="#" class="navbar-brand font-weight-bold"> <i class="fas fa-fighter-jet"></i> <i class="bi bi-alarm-fill"></i>Jet File System</a>
        </div>
        <div class="col-lg-5 col-xs-12 m-1">
            <form action="./index.php" method="POST">
            <div class="input-group">
                    <input type="search" name="buscar" id="buscar" class="form-control border-right-0 border" placeholder="Buscar...">
                    <div class="input-group-append">
                        <button type="submit" name="submitBuscar" class="btn btn-secondary"><i class="fas fa-search"></i> </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2  col-xs-6 m-1">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalForm">
                Create File/ Folder
            </button>
        </div>
        <div class="col-lg-2 col-xs-6 m-1">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalFormNew">
                Upload File/ Folder
            </button>
        </div>
    </div>
</nav>