<?php

require_once '../../Controller/UserController_B.php';

$userController = new UserController();
$users = $userController->getUsers();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController();
    $controller->createUser($_POST['name'], $_POST['email'], $_POST['password']);
    header('Location: list_users.php');
    exit;
}
?>









<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Monsterlite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Monster admin lite design, Monster admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Monster Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Cultivio</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- le logo en coin   -->
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/log.png">
    <!-- Custom CSS -->
    <link href="./assets/plugins/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
    .corner-logo {
    height:90px; /* Ajustez la taille du logo selon vos besoins */
    width: auto;  /* Garde les proportions de l'image */
    margin-left: 10px; /* Espace à gauche pour le décaler légèrement du bord */
    margin-top: 10px;  /* Espace en haut pour le décaler légèrement du bord */
}

</style>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="indexback.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                         <span>
                        <div class="navbar-header" data-logobg="skin6">
                            <!-- Logo en coin -->
                            <a class="navbar-brand" href="indexback.html">
                                <img src="./assets/images/log.png" alt="Cultivio Logo" class="corner-logo">
                            </a>
                        </div>
                    </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto mt-md-0 ">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                        <li class="nav-item hidden-sm-down">
                            <form class="app-search ps-3">
                                <input type="text" class="form-control" placeholder="Search for..."> <a
                                    class="srh-btn"><i class="ti-search"></i></a>
                            </form>
                        </li>
                    </ul>

                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./assets/images/users/1.jpg" alt="user" class="profile-pic me-2">admin cultivio
                            </a>
                            <ul class="dropdown-menu show" aria-labelledby="navbarDropdown"></ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="index.php" aria-expanded="false"><i class="me-3 far fa-clock fa-fw"
                                    aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a></li>
                        
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="l.php" >
                                            <i class="me-3 fa fa-table" aria-hidden="true"></i><span class="hide-menu">Liste des réclamations</span>
                                        </a>
                                    </li>
                                    
                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                        href="sl.php" aria-expanded="false"><i class="me-3 fa fa-font"
                                            aria-hidden="true"></i><span class="hide-menu">Solutions Reclamations</span></a></li>
                                    
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="event-back.php" aria-expanded="false"><i class="me-3 fa fa-font"
                                    aria-hidden="true"></i><span class="hide-menu">Events</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="liste.php" aria-expanded="false"><i class="me-3 fa fa-columns"
                                    aria-hidden="true"></i><span class="hide-menu">Shop</span></a></li>
                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                        href="avis-back.php"     aria-expanded="false"><i class="me-3 fa fa-columns"
                                            aria-hidden="true"></i><span class="hide-menu">Forum</span></a></li>
                                            <a class="sidebar-link waves-effect waves-dark sidebar-link" 
                                href="User_gestion.php" aria-expanded="false">
                                <i class="me-3 fa fa-users" aria-hidden="true"></i>
                                <span class="hide-menu">Liste des utilisateurs</span>
                            </a>
                        

                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        
        <div class="page-wrapper">
           

                    <div class="page-wrapper">
          
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Tables</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Users List </h5>
                    
                            </div>
                            <table class="table">
                            <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="3">Aucun utilisateur trouvé.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['Nom']); ?></td>
                            <td><?php echo htmlspecialchars($user['Email']); ?></td>
                            <td>
                                 <!-- Bouton Modifier -->
    <a href="edit_user.php?id=<?php echo $user['IdUtilisateur']; ?>" class="button edit-button">Modifier</a>
    <!-- Bouton Supprimer -->
    <a href="delete_user.php?id=<?php echo $user['IdUtilisateur']; ?>" class="button delete-button">Supprimer</a>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
                            </table>
                        </div>
                        <div class="card">
                        <div class="admin-container">
        <h2>Ajouter un Utilisateur</h2>
        <form action="" method="POST">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" required>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Ajouter</button>
        </form>
    </div>
                           
   
          
            <footer class="footer text-center">
            </footer>
        </div>

    </div>
    
    
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="dist/js/waves.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
        $('#zero_config').DataTable();
    </script>
                </div>
            </div>
            
           
            <!-- footer -->
            <footer class="footer text-center">
                © 2024  Cultivio
            </footer>
           
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="./assets/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="./assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--flot chart-->
    <script src="./assets/plugins/flot/jquery.flot.js"></script>
    <script src="./assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>

    
</body>

</html>