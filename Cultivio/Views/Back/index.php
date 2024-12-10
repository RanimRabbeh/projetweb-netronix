<?php
// Include the necessary files (you can use require_once for better performance)
require_once __DIR__ . '/../../controllers/ForumController.php';
require_once __DIR__ . '/../../models/Forum.php';

require_once __DIR__ . '/../../controllers/CommentController.php';
require_once __DIR__ . '/../../models/comment.php';
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cultivio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the controller
$forumController = new ForumController($conn);
$commentController = new CommentController($conn);

// Call the method directly to display all forums
$forums = $forumController->displayAllForums();
$comments = $commentController->displayAllComments();

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
        height: 90px;
        /* Ajustez la taille du logo selon vos besoins */
        width: auto;
        /* Garde les proportions de l'image */
        margin-left: 10px;
        /* Espace à gauche pour le décaler légèrement du bord */
        margin-top: 10px;
        /* Espace en haut pour le décaler légèrement du bord */
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
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                            <div class="navbar-header" data-logobg="skin6">
                                <!-- Logo en coin -->
                                <a class="navbar-brand" href="index.html">
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
                                href="index.html" aria-expanded="false"><i class="me-3 far fa-clock fa-fw"
                                    aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="Views/list.html" aria-expanded="false"><i class="me-3 fa fa-table"
                                    aria-hidden="true"></i><span class="hide-menu">Liste des réclamations</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="me-3 fa fa-font"
                                    aria-hidden="true"></i><span class="hide-menu">Events</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="me-3 fa fa-columns"
                                    aria-hidden="true"></i><span class="hide-menu">Shop</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="me-3 fa fa-columns"
                                    aria-hidden="true"></i><span class="hide-menu">Forum</span></a></li>


                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Dashboard</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>


            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex">
                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Les avis des clients </h4>
                                <div class="col-md-2 ms-auto">
                                    <select class="form-select shadow-none" id="eventSelect">
                                        <option>Choisi un evenement</option>
                                        <option value="louvre">Musée du Louvre - France</option>
                                        <option value="bardo">Bardo Museum - Tunisie</option>
                                        <option value="eiffel">Tour Eiffel - France</option>
                                        <option value="sagrada">Sagrada Familia - Spain</option>
                                        <option value="rome">Rome - Italy</option>
                                        <option value="cairo">Art Gallery Cairo - Egypt</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive mt-5">
                                <table class="table stylish-table no-wrap">
           
                                

                                    <!-- Display the forums avis -->
                                    <?php if (isset($forums) && is_array($forums) && !empty($forums)): ?>
                                        <?php foreach ($forums as $forum): ?>
                                            <div class="forum">
                                                <p>Subject: <?php echo htmlspecialchars($forum['sujetForum']); ?></p>
                                                <p>Content: <?php echo htmlspecialchars($forum['contenu']); ?></p>
                                                <!-- Add delete button -->
                                                <form action="/cultivio/index.php?action=deleteForum" method="POST" style="display:inline;">
                                                    <input type="hidden" name="idForum" value="<?php echo htmlspecialchars($forum['IdForum']); ?>">
                                                    <button type="submit" class="delete-btn">Delete</button>
                                                </form>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>No forums available or data is empty.</p>
                                    <?php endif; ?>


                                    <style>
                                        .delete-btn {
                                            background-color: red;
                                            color: white;
                                            border: none;
                                            padding: 5px 10px;
                                            cursor: pointer;
                                            border-radius: 5px;
                                        }

                                        .delete-btn:hover {
                                            background-color: darkred;
                                        }
                                    </style>
                                    <!-- <tbody>
                                            <tr>
                                                <td style="width:50px;"><span class="round">S</span></td>
                                                <td class="align-middle">
                                                    <h6>Sunil Joshi</h6>
                                                </td>
                                                <td class="align-middle">Une expérience formidable au Louvre !</td>
                                                <td class="align-middle text-center">
                                                    <button class="btn btn-sm btn-warning me-2">Modifier</button>
                                                    <button class="btn btn-sm btn-danger">Supprimer</button>
                                                </td>
                                            </tr>
                                            <tr class="active">
                                                <td><span class="round"><img src="./assets/images/users/2.jpg"
                                                            alt="user" width="50"></span></td>
                                                <td class="align-middle">
                                                    <h6>Andrew</h6>
                                                </td>
                                                <td class="align-middle">La Tour Eiffel est magique la nuit !</td>
                                                <td class="align-middle text-center">
                                                    <button class="btn btn-sm btn-warning me-2">Modifier</button>
                                                    <button class="btn btn-sm btn-danger">Supprimer</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="round round-success">B</span></td>
                                                <td class="align-middle">
                                                    <h6>Bhavesh Patel</h6>
                                                </td>
                                                <td class="align-middle">Sagrada Familia, un chef-d'œuvre incroyable !</td>
                                                <td class="align-middle text-center">
                                                    <button class="btn btn-sm btn-warning me-2">Modifier</button>
                                                    <button class="btn btn-sm btn-danger">Supprimer</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="round round-primary">N</span></td>
                                                <td class="align-middle">
                                                    <h6>Nirav Joshi</h6>
                                                </td>
                                                <td class="align-middle">Le Colisée est fascinant, plein d'histoire !</td>
                                                <td class="align-middle text-center">
                                                    <button class="btn btn-sm btn-warning me-2">Modifier</button>
                                                    <button class="btn btn-sm btn-danger">Supprimer</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="round round-warning">M</span></td>
                                                <td class="align-middle">
                                                    <h6>Micheal Doe</h6>
                                                </td>
                                                <td class="align-middle">Le musée du Bardo est très intéressant.</td>
                                                <td class="align-middle text-center">
                                                    <button class="btn btn-sm btn-warning me-2">Modifier</button>
                                                    <button class="btn btn-sm btn-danger">Supprimer</button>
                                                </td>
                                            </tr>
                                        </tbody> -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex">
                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Les commentairess des clients</h4>
                                <div class="col-md-2 ms-auto">
                                    <select class="form-select shadow-none" id="eventSelect">
                                        <option>Choisi un evenement</option>
                                        <option value="louvre">Musée du Louvre - France</option>
                                        <option value="bardo">Bardo Museum - Tunisie</option>
                                        <option value="eiffel">Tour Eiffel - France</option>
                                        <option value="sagrada">Sagrada Familia - Spain</option>
                                        <option value="rome">Rome - Italy</option>
                                        <option value="cairo">Art Gallery Cairo - Egypt</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive mt-5">
                                <table class="table stylish-table no-wrap">
                              
                                    <tbody>
                                        <?php if (isset($comments) && is_array($comments) && !empty($comments)): ?>
                                            <?php foreach ($comments as $comment): ?>
                                                <div class="comment">
                                                    <p>Forum ID: <?php echo htmlspecialchars($comment['IdForum']); ?></p>
                                                    <p>User: <?php echo htmlspecialchars($comment['nomUtilisateur']); ?></p>
                                                    <p>Content: <?php echo htmlspecialchars($comment['Contenu']); ?></p>
                                                    <p>Date: <?php echo htmlspecialchars($comment['DatePublication']); ?></p>
                                                    <!-- Add delete button -->
                                                    <form action="/cultivio/index.php?action=deleteComment" method="POST" style="display:inline;">
                                                        <input type="hidden" name="idComment" value="<?php echo htmlspecialchars($comment['IdCommentaire']); ?>">
                                                        <button type="submit" class="delete-btn">Delete</button>
                                                    </form>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p>No comments available or data is empty.</p>
                                        <?php endif; ?>

                                        <style>
                                            .comment {
                                                border: 1px solid #ddd;
                                                padding: 10px;
                                                margin: 10px 0;
                                                border-radius: 5px;
                                            }

                                            .delete-btn {
                                                background-color: red;
                                                color: white;
                                                border: none;
                                                padding: 5px 10px;
                                                cursor: pointer;
                                                border-radius: 5px;
                                            }

                                            .delete-btn:hover {
                                                background-color: darkred;
                                            }
                                        </style>
                                        <!-- Additional rows omitted for brevity -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add a script to handle redirection -->
            <script>
                document.querySelectorAll('.modifier-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const comment = this.getAttribute('data-comment');
                        window.location.href = `http://localhost/Cultivio/Views/EditComment.php?comment=${encodeURIComponent(comment)}`;
                    });
                });
            </script>


        </div>
    </div>
    </div>
    </div>
    </div>

    </div>

    <!-- footer -->
    <footer class="footer text-center">
        © 2024 Cultivio
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