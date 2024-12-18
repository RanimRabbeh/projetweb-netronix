<?php
require_once '../../config.php';
require_once '../../Controller/SubjectC.php';
require_once '../../Controller/AvisC.php';
require_once '../../Controller/CommentC.php';  // Include the Avis controller

$pdo = Config::getConnexion(); // Get the database connection
$query = "SELECT * FROM Avis"; // Query to get all reviews from the database

// Initialize the controller
$controller = new AvisC();

// Query to get all reviews from the Avis table
$avisResult = $pdo->query($query); // Execute the query

// Check if the query was successful and if there are any results
if (!$avisResult) {
    die('Query failed: ' . $pdo->errorInfo());
}

$query = "SELECT * FROM subjects";

// Initialize the controller
$controller = new SubjectC();

// Query to get all subjects from the database
$query = "SELECT * FROM subjects"; // Adjust the table name and column names if necessary
$subjectsResult = Config::getConnexion()->query($query);

$commentModel = new Comment();

$comments = CommentC::getAllComments($pdo);
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
    <!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- jQuery, Popper.js, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
</head>
<style>
    .corner-logo {
    height:90px; 
    width: auto;  
    margin-left: 10px; 
    margin-top: 10px; 
}
</style>

<body>
    
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="navbar-brand" href="index.php">

                        <b class="logo-icon">

                        </b>
                         <span>
                        <div class="navbar-header" data-logobg="skin6">
                            <!-- Logo en coin -->
                            <a class="navbar-brand" href="index.php">
                                <img src="./assets/images/log.png" alt="Cultivio Logo" class="corner-logo">
                            </a>
                        </div>
                    </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav me-auto mt-md-0 ">

                        <li class="nav-item hidden-sm-down">
                            <form class="app-search ps-3">
                                <input type="text" class="form-control" placeholder="Search for..."> <a
                                    class="srh-btn"><i class="ti-search"></i></a>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
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
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
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
            </div>
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
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-0">Manage Subjects</h5>
                    <!-- Add Subject Button -->
                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addSubjectModal">Add Subject</button>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Subject Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($subject = $subjectsResult->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td><?php echo $subject['name']; ?></td>
                                    <td>
                                        <!-- Modify Button (opens modal or redirects to edit page) -->
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="<?php echo $subject['id']; ?>" data-name="<?php echo $subject['name']; ?>">Modify</button>
                                        <!-- Delete Button -->
                                        <a href="delete_subject.php?id=<?php echo $subject['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this subject?')">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
           <!-- Modal for Adding New Subject -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectModalLabel">Add New Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <form action="add_subject.php" method="POST" onsubmit="return validateSubjectForm(this)">
        <div class="form-group">
            <label for="subjectName">Subject Name</label>
            <input type="text" class="form-control" id="subjectName" name="subjectName" >
            <span id="subjectNameError" class="error-message"></span> <!-- Error message for subject name -->
        </div>
        <button type="submit" class="btn btn-primary">Add Subject</button>
    </form>
</div>
        </div>
    </div>
</div>

<!-- Modal for Modifying Subject -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="update_subject.php" method="POST">
                    <input type="hidden" name="id" id="subjectId">
                    <div class="form-group">
                        <label for="newName">New Subject Name</label>
                        <input type="text" class="form-control" id="newName" name="newName" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
                <div class="row">
                    <div class="col-12">
                    <div class="card">
    <div class="card-body">
        <h5 class="card-title m-b-0">Manage Avis (Reviews)</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Subject</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date Post</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
    <?php while ($avis = $avisResult->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?php echo $avis['Nom']; ?></td>
            <td><?php echo $avis['Prenom']; ?></td>
            <td><?php echo $avis['Email']; ?></td>
            <td><?php echo $avis['Description']; ?></td>
            <td><?php echo $avis['Datepost']; ?></td>
            <td>
                <!-- Update Button -->
                <button class="btn btn-warning" data-toggle="modal" data-target="#updateModal<?php echo $avis['Idavis']; ?>">Update</button>

                <!-- Delete Button -->
                <a href="delete-review.php?Idavis=<?php echo $avis['Idavis']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this review?')">Delete</a>
            </td>
        </tr>

        <!-- Update Modal -->
        <div class="modal fade" id="updateModal<?php echo $avis['Idavis']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="update-review.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="idavis" value="<?php echo $avis['Idavis']; ?>">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" required><?php echo $avis['Description']; ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="updateReview">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</tbody>
    </table>
    </div>
    </div>
    </div>
    <div class="container">
        <h1>Manage Comments</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Comment ID</th>
                    <th>Review ID</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?= $comment['id'] ?></td>
                        <td><?= $comment['avis_id'] ?></td>
                        <td><?= $comment['comment'] ?></td>
                        <td><?= $comment['date_post'] ?></td>
                        <td>
                            <!-- Delete -->
                            <a href="delete_comment.php?id=<?= $comment['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</a>
                            <!-- Update (Modal Trigger) -->
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editCommentModal" data-id="<?= $comment['id'] ?>" data-text="<?= $comment['comment'] ?>">Update</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Update Comment Modal -->
    <div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="update_comment.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="commentId">
                        <div class="form-group">
                            <label for="commentText">Comment</label>
                            <textarea name="text" id="commentText" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

                        
    <script>
    // Function to validate the subject name input
    function validateSubjectForm(form) {
        let isValid = true;

        // Clear previous error messages
        document.getElementById('subjectNameError').textContent = '';

        // Subject name validation: Only letters and must be filled
        const subjectName = form.subjectName.value;
        const subjectNamePattern = /^[A-Za-z\s]+$/;  // Allows only letters and spaces

        if (!subjectNamePattern.test(subjectName) || subjectName.length === 0) {
            document.getElementById('subjectNameError').textContent = 'Subject Name must contain only letters and spaces and cannot be empty.';
            isValid = false;
        }

        return isValid;  // Return false to prevent form submission if validation fails
    }
</script>
    </div>
    <style>
        .error-message {
    font-size: 12px;
    color: red;
    margin-top: 5px;
}
    </style>
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
    <script>
    // JavaScript to fill the modal with the current subject details
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var subjectId = button.data('id');
        var subjectName = button.data('name');
        
        var modal = $(this);
        modal.find('#subjectId').val(subjectId);
        modal.find('#newName').val(subjectName);
    });
    // JavaScript to fill the modal with the current Avis details
$('#editAvisModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var avisId = button.data('id');
    var avisSubject = button.data('subject');
    var avisDescription = button.data('description');

    var modal = $(this);
    modal.find('#avisId').val(avisId);
    modal.find('#avisSubject').val(avisSubject);
    modal.find('#avisDescription').val(avisDescription);
});
</script>
                </div>
            </div>

        </div>
    </div>
    <script src="./assets/plugins/jquery/dist/jquery.min.js"></script>
    <script src="./assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="js/waves.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/custom.js"></script>
    <script src="./assets/plugins/flot/jquery.flot.js"></script>
    <script src="./assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>

    
</body>

</html>