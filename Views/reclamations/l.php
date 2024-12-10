<?php
require_once '../../Controller/SatisfactionController.php';

// Initialiser le contrôleur et appeler la méthode pour obtenir les données
$controller = new SatisfactionController();
$controller->afficherTauxSatisfaction();
require_once '../../Controller/ReclamationController.php';
session_start(); // Démarre la session pour accéder à $_SESSION['admin']

// Initialisation du contrôleur
$controller = new ReclamationController();

// Récupération des réclamations via le contrôleur
$reclamations = $controller->getReclamations();
// Récupération du nombre de réclamations par type
$reclamationsByType = $controller->getReclamationsCountByType();
// Récupération du type de réclamation le plus fréquent et son pourcentage
$mostCommonTypeInfo = $controller->getMostCommonReclamationTypeAndPercentage();
// Récupération du nombre de réclamations traitées et non traitées
$reclamationsByEtat = $controller->getReclamationsCountByEtat();

// Initialisation des variables
$traitées = 0;
$nonTraitées = 0;

foreach ($reclamationsByEtat as $etat) {
    if ($etat['Etat'] === 'traité') {
        $traitées = $etat['count'];
    } elseif ($etat['Etat'] === 'non traité') {
        $nonTraitées = $etat['count'];
    }
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
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/log.png">
    <!-- Custom CSS -->
    <link href="../../assets/plugins/chartist/dist/chartist.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom CSS -->
    <link href="../../css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="listcss.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
.main-container {
    display: flex;
    flex-direction: column;
    gap: 15px; /* Réduit l'espace entre les sections */
    max-width: 800px; /* Réduit encore la largeur totale */
    margin: 0 auto; /* Centre toujours le contenu */
}

.top-stats {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 10px; /* Réduit l'espacement entre les éléments */
}

.stats-most-container,
.stats-container,
.stats-reclamations {
    flex: 1;
    min-width: 200px;
    max-width: 250px; /* Diminue encore la largeur maximale */
    padding: 10px; /* Réduit les marges internes */
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center; /* Centre le texte */
}

.list-reclamations {
    padding: 10px; /* Réduit le padding interne */
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    max-width: 800px; /* Réduit également la taille maximale */
    margin: 0 auto; /* Centre toujours la liste */
}



</style>
<style>
    .corner-logo {
    height:90px; /* Ajustez la taille du logo selon vos besoins */
    width: auto;  /* Garde les proportions de l'image */
    margin-left: 10px; /* Espace à gauche pour le décaler légèrement du bord */
    margin-top: 10px;  /* Espace en haut pour le décaler légèrement du bord */
}
.modal-dialog {
    max-width: 80%;  /* Taille de la fenêtre modale */
}

.modal-content {
    padding: 20px;
}

.modal-header {
    background-color: #f1f1f1;
    border-bottom: 1px solid #ddd;
}

.modal-body {
    background-color: #fff;
    max-height: 400px;  /* Limite de hauteur pour le contenu */
    overflow-y: auto;
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
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
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
                            <a class="navbar-brand" href="../../index.html">
                                <img src="../../assets/images/log.png" alt="Cultivio Logo" class="corner-logo">
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
                                <img src="../../assets/images/users/1.jpg" alt="user" class="profile-pic me-2">admin cultivio
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
                                href="../../index.html" aria-expanded="false"><i class="me-3 far fa-clock fa-fw"
                                    aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a></li>
                        
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0);" >
                                            <i class="me-3 fa fa-table" aria-hidden="true"></i><span class="hide-menu">Liste des réclamations</span>
                                        </a>
                                    </li>
                                    
                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                        href="../solution/sl.php" aria-expanded="false"><i class="me-3 fa fa-font"
                                            aria-hidden="true"></i><span class="hide-menu">Solutions Reclamations</span></a></li>
                                    
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="me-3 fa fa-font"
                                    aria-hidden="true"></i><span class="hide-menu">Events</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="me-3 fa fa-columns"
                                    aria-hidden="true"></i><span class="hide-menu">Shop</span></a></li>
                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                        href="#"     aria-expanded="false"><i class="me-3 fa fa-columns"
                                            aria-hidden="true"></i><span class="hide-menu">Forum</span></a></li>
                        

                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Liste des réclamations</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">réclamations</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="main-container">
            <?php if (isset($tauxSatisfaction)): ?>
    <p>Le taux de satisfaction global est de : <?php echo round($tauxSatisfaction, 2); ?>%</p>
    <!-- Conteneur pour le graphique -->
    <canvas id="pieChart" width="400" height="400"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Satisfaits', 'Insatisfaits'],
                datasets: [{
                    data: [<?php echo round($tauxSatisfaction, 2); ?>, <?php echo 100 - round($tauxSatisfaction, 2); ?>],
                    backgroundColor: ['#4caf50', '#f44336'],
                    borderColor: ['#fff', '#fff'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>
<?php else: ?>
    <p>Les données de satisfaction sont indisponibles pour le moment.</p>
<?php endif; ?>

        
    <div class="top-stats">
        <!-- Statistique du type de réclamation le plus fréquent -->
        <div class="stats-most-container">
            <h2>Statistiques du type de réclamation le plus fréquent</h2>
            <div class="statistic-badge">
               
                <div class="badge-details">
                    <span class="badge-type"><?= htmlspecialchars($mostCommonTypeInfo['type']) ?></span>
                    <span class="badge-count"><?= htmlspecialchars($mostCommonTypeInfo['count']) ?> réclamations</span>
                    <span class="badge-percentage"><?= number_format($mostCommonTypeInfo['percentage'], 2) ?>%</span>
                    <span class="badge-status"><?= htmlspecialchars($mostCommonTypeInfo['status']) ?></span>
                </div>
            </div>
        </div>

        <!-- Statistiques des réclamations -->
        <div class="stats-container">
            <h2>Statistiques des réclamations</h2>
            <table>
                <thead>
                    <tr>
                        <th>Type de Réclamation</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reclamationsByType as $type): ?>
                        <tr>
                            <td><?= htmlspecialchars($type['TypeDeReclamation']) ?></td>
                            <td><?= htmlspecialchars($type['count']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Réclamations traitées / non traitées -->
        <div class="stats-reclamations">
            <h2>Statut des réclamations</h2>
            <p>Réclamations traitées : <strong><?= $traitées ?></strong></p>
            <p>Réclamations non traitées : <strong><?= $nonTraitées ?></strong></p>
        </div>
    </div>

    
</div>
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
              
                <div class="row"> 
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des réclamations</h4>
                <h6 class="card-subtitle">Tableau contenant les informations des réclamations</h6>
                <div class="table-responsive">
                    <table class="table user-table no-wrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Date de la réclamation</th>
                                <th class="border-top-0">Type de la réclamation</th>
                                <th class="border-top-0">Description</th>
                                <th class="border-top-0">Pièces Jointes</th>
                                <th class="border-top-0">Contact</th>
                                <th class="border-top-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reclamations as $reclamation): ?>
                                <tr>
                                    <td><?= htmlspecialchars($reclamation['IdReclamation']) ?></td>
                                    <td><?= htmlspecialchars($reclamation['DateDeLaReclamation']) ?></td>
                                    <td><?= htmlspecialchars($reclamation['TypeDeReclamation']) ?></td>
                                    <td><?= htmlspecialchars($reclamation['DescriptionDeLaReclamation']) ?></td>
                                    <td>
                                        <?php if (!empty($reclamation['PiecesJointes'])): ?>
                                            <a href="<?= htmlspecialchars($reclamation['PiecesJointes']) ?>" target="_blank">Voir le document</a>
                                        <?php else: ?>
                                            Aucun document
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($reclamation['Contact']) ?></td>
                                    <td>
                                    <a href="/backz/Views/solution/add.php?idreclamation=<?= htmlspecialchars($reclamation['IdReclamation']) ?>&idadmin=<?= htmlspecialchars($_SESSION['admin']) ?>">Ajouter Solution</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                © 2021 Monster Admin by <a href="https://www.wrappixel.com/">wrappixel.com</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="../../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../js/custom.js"></script>
    
</body>

</html>