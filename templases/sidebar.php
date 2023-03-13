<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-solid fa-globe"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SITO <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-users"></i>
            <span>Adminstración candidatos</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="aceptados.php">
            <i class="fas fa-users-cog"></i>
            <span>Adminstración aceptados </span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <?php
    if ($_SESSION['rol'] == 'admin') {
    ?>
        <div class="sidebar-heading">
            Adminstración
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-school"></i>
                <span>Carreras</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Opciones para carreras:</h6>
                    <a class="collapse-item" href="carrera.php">Agregar carrera</a>
                </div>
            </div>
        </li>

        <!-- Nav Item drop down para los usuarios -->
        <li class="nav-item">
            <a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#collpaseOne" aria-expanded="true" aria-controls="collpaseOne">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>
            <div id="collpaseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"> Opciones usuarios </h6>
                    <a class="collapse-item" href="usuarios.php">Admin usuarios</a>
                </div>
            </div>
        </li>
    <?php
    }
    ?>
    <!-- End of Sidebar -->

    <!-- Hide side menu -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <!-- End of hide side menu -->
</ul>