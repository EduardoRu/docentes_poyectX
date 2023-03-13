<?php include "templases/header.php" ?>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand bg-gradient-primary topbar mb-4 static-top">
                    <a class="navbar-brand text-white" href="formulario_candidato.php"><i class="fas fa-solid fa-globe"></i> Inicio</a>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item">
                            <a class="nav-link " href="login.php" role="button">
                                <i class="mr-2 d-lg-inline fas fa-user fa-sm text-white"></i>
                                <span class="mr-2 d-none d-lg-inline text-white">Inicia sesión</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- Section: Design Block -->
                <section class="vh-100">
                    <div class="container py-5">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                    <div class="card-body p-5 text-center">

                                        <h3 class="mb-5">Inicio de sesión</h3>

                                        <form action="logincontroller.php" method="post">
                                            <div class="form-outline mb-4">
                                                <input type="email" id="emailAdmin" name="emailAdmin" class="form-control form-control-lg" />
                                                <label class="form-label" for="email_personal">Correo electronico</label>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="password" id="passAdmin" name="passAdmin" class="form-control form-control-lg" />
                                                <label class="form-label" for="pass_personal">Contraseña</label>
                                            </div>

                                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Iniciar sesión">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Section: Design Block -->
            </div>
        </div>
    </div>
</body>
<?php include "templases/footer.php" ?>