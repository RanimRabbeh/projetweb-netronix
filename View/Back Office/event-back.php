<?php
include '../../Controller/EvenementsC.php';
include '../../Controller/ReservationsC.php';
$reservationC = new ReservationC();
$reservations = $reservationC->getAllReservations();


$error = "";

$event= null;
$evenementsC = new evenementsC();

if (
   isset($_POST["Nomevenement"])  && $_POST["Lieuevenement"] && $_POST["Dateevenement"]  && $_POST["Prixevenement"] && $_POST["Placedisponible"] 
) {
   if (
       !empty($_POST["Nomevenement"])  && !empty($_POST["Lieuevenement"])  && !empty($_POST["Dateevenement"]) && !empty($_POST["Prixevenement"]) && !empty($_POST["Placedisponible"])
       ) {
           $event = new Evenements(
               null,
               $_POST['Nomevenement'],
               $_POST['Lieuevenement'],
               $_POST['Dateevenement'],
               $_POST['Prixevenement'],
               $_POST['Placedisponible'],
           );
           //
               
           $evenementsC->addEvent($event);
   
          
       } else
           $error = "Missing information";
   }
   $events = $evenementsC->getAllEvents();




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
                                <h5 class="card-title m-b-0">Evenements </h5>
                                <div class="btn-group" role="group" aria-label="Event Actions">
                                        <button type="button" class="btn btn-primary" onclick="showAddEventModal()">Ajouter un Evenement</button>
                                </div>
                            </div>
                            <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">Nom</th>
                                      <th scope="col">Localisation</th>
                                      <th scope="col">Date evenement</th>
                                      <th scope="col">Prix Evenemment</th>
                                      <th scope="col">Places disponibles</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                        foreach ($events as $event) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($event['Nomevenement']) . "</td>";
                            echo "<td>" . htmlspecialchars($event['Lieuevenement']) . "</td>";
                            echo "<td>" . htmlspecialchars($event['Dateevenement']) . "</td>";
                            echo "<td>" . htmlspecialchars($event['Prixevenement']) . "$</td>";
                            echo "<td>" . htmlspecialchars($event['Placedisponible']) . "</td>";
                            echo '<td><button class="btn btn-primary" onclick="openEditEventModal(' . htmlspecialchars($event['Idevenement']) . ')">Modifier</button>';
                            echo '<td><button class="btn btn-danger" onclick="deleteEvent(' . htmlspecialchars($event['Idevenement']) . ')">Supprimer</button></td>';
                            echo "</tr>";
                        }
                        ?>
                                  </tbody>
                            </table>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Reservations</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Cin</th>
                                                <th>Evenement choisi</th>
                                                <th>Date de l'evenement</th>
                                                <th>Date de la Reservation</th>
                                                <th>Baggage</th>
                                            </tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($reservations as $reservation): ?>
    <tr>
        <td><?= htmlspecialchars($reservation['Nom']) ?></td>
        <td><?= htmlspecialchars($reservation['Prenom']) ?></td>
        <td><?= htmlspecialchars($reservation['CIN']) ?></td>
        <td><?= htmlspecialchars($reservation['eventname']) ?></td>
        <td><?= htmlspecialchars($reservation['eventdate']) ?></td>
        <td><?= htmlspecialchars($reservation['dateReservation']) ?></td>
        <td><?= htmlspecialchars($reservation['Baggage']) ?>KG</td>
        
        <td>
            <button 
                class="btn btn-danger" 
                onclick="deleteReservation('<?= htmlspecialchars($reservation['CIN']) ?>')">
                Delete
            </button>
        </td>
    </tr>
<?php endforeach; ?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Cin</th>
                                                <th>Evenement choisi</th>
                                                <th>Date de l'evenement</th>
                                                <th>Date de la Reservation</th>
                                                <th>Baggage</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div id="editEventModal" style="display:none;">
    <div class="modal-content">
        <h2>Modifier l'Evenement</h2>
        <form id="editEventForm">
            <input type="hidden" id="editEventId" name="editEventId" />
            <label for="editEventName">Nom d'evenement :</label>
            <input type="text" id="editEventName" name="editEventName" required />
            
            <label for="editEventLocation">Localisation de l'evenement:</label>
            <input type="text" id="editEventLocation" name="editEventLocation" required />

            <label for="editEventDate">Date de l'evenement:</label>
            <input type="date" id="editEventDate" name="editEventDate" required />

            <label for="editEventPrice">Prix de l'evenement</label>
            <input type="number" id="editEventPrice" name="editEventPrice" required />

            <label for="editEventPlaces">Places Disponibles</label>
            <input type="text" id="editEventPlaces" name="editEventPlaces" required />

            <button type="submit">Sauvgarder</button>
            <button type="button" onclick="closeEditModal()">Annuler</button>
        </form>
    </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>

            
            </div>
            <div class="modal" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Add New Event</h5>
                <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="addEventForm" method="POST" action="path_to_your_php_script.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="eventName">Nom d'evenement :</label>
            <input type="text" class="form-control" id="eventName" name="Nomevenement" placeholder="Enter event name" required>
        </div>
        <div class="form-group">
            <label for="eventLocation">Localisation de l'evenement:</label>
            <input type="text" class="form-control" id="eventLocation" name="Lieuevenement" placeholder="Enter location" required>
        </div>
        <div class="form-group">
            <label for="eventDate">Date de l'evenement:</label>
            <input type="date" class="form-control" id="eventDate" name="Dateevenement" required>
        </div>
        <div class="form-group">
            <label for="eventPrice">Prix de l'evenement</label>
            <input type="text" class="form-control" id="eventPrice" name="Prixevenement" placeholder="Enter price" required>
        </div>
        <div class="form-group">
            <label for="eventPlaces">Places Disponibles</label>
            <input type="text" class="form-control" id="eventPlaces" name="Placedisponible" placeholder="Enter number of places" required>
        </div>
        <div class="form-group">
            <label for="eventImage">Image de l'evenement </label>
            <input type="file" class="form-control" id="eventimage" name="image" accept="image/*" required>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" onclick="closeModal()">Fermer</button>
    <button type="button" class="btn btn-primary" onclick="submitForm()">Sauvgarder</button>
</div>

            </div>
        </div>
    </div>
</div>

          
            <footer class="footer text-center">
            </footer>
        </div>

    </div>
    <script>
        function showAddEventModal() {
    const modal = document.getElementById('addEventModal');
    modal.style.display = 'block';
}

function closeModal() {
    const modal = document.getElementById('addEventModal');
    modal.style.display = 'none';
}

function validateForm() {
    const eventName = document.getElementById('eventName').value.trim();
    const eventLocation = document.getElementById('eventLocation').value.trim();
    const eventDate = document.getElementById('eventDate').value;
    const eventPrice = document.getElementById('eventPrice').value.trim();
    const eventPlaces = document.getElementById('eventPlaces').value.trim();

    const nameRegex = /^[a-zA-Z0-9 ]{1,50}$/; // Only alphanumeric and spaces, max 50 chars
    const placesRegex = /^\d+\/\d+$/; // Matches "number/number"
    let isValid = true;

    // Clear previous error messages
    clearErrorMessages();

    // Validate Event Name
    if (!nameRegex.test(eventName)) {
        displayErrorMessage('eventName', "Event Name must be between 1 and 50 characters long and contain no special symbols.");
        isValid = false;
    }

    // Validate Event Location
    if (!nameRegex.test(eventLocation)) {
        displayErrorMessage('eventLocation', "Location must be between 1 and 50 characters long and contain no special symbols.");
        isValid = false;
    }

    // Validate Event Date
    const currentDate = new Date();
    const selectedDate = new Date(eventDate);
    if (!eventDate || selectedDate < currentDate) {
        displayErrorMessage('eventDate', "Date of Event must not be before today's date.");
        isValid = false;
    }

    // Validate Event Price
    if (!/^\d+$/.test(eventPrice)) {
        displayErrorMessage('eventPrice', "Price must contain only numeric characters.");
        isValid = false;
    }

    // Validate Places Available
    if (!placesRegex.test(eventPlaces)) {
        displayErrorMessage('eventPlaces', "Places Available must follow the format 'number/number' (e.g., 20/45).");
        isValid = false;
    }

    return isValid; // If all validations pass, return true
}

// Function to display error messages next to form fields
function displayErrorMessage(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorSpan = document.createElement('span');
    errorSpan.classList.add('error-message');
    errorSpan.style.color = 'red';
    errorSpan.textContent = message;

    // Append error message after the input field
    field.parentNode.appendChild(errorSpan);
}

// Function to clear any previous error messages
function clearErrorMessages() {
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(error => error.remove());
}

function submitForm() {
    // First, validate the form
    if (validateForm()) {
        // Grab the form data
        const formData = new FormData(document.getElementById('addEventForm'));

        // Use fetch to send data to the server
        fetch('path_to_your_php_script.php', {
            method: 'POST',
            body: formData // This sends the form data to the PHP backend
        })
        .then(response => response.json()) // Assuming the server sends back a JSON response
        .then(data => {
            // Handle the server response
            if (data.success) {
                alert('Event saved successfully!');
                closeModal();  // Close the modal if the event is saved
            } else {
                alert('Error: ' + data.message); // Show error message returned by PHP
            }
        })
        .catch(error => {
            alert('Error: ' + error); // Handle any errors with the request
        });
    }
}
function deleteEvent(eventId) {
    // Confirm the deletion
    if (confirm('Are you sure you want to delete this event?')) {
        // Use fetch to send the delete request to deleteEvent.php
        fetch('deleteEvent.php?id=' + eventId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Event deleted successfully!');
                    // Reload the page to reflect the change
                    location.reload();
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => {
                alert('Error: ' + error);  // Handle any errors
            });
    }
}

    </script>
    <script>
        function openEditEventModal(eventId) {
    // Fetch the event data from the server using the event ID
    fetch('getEventData.php?id=' + eventId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Fill the form fields with the event data
                document.getElementById('editEventId').value = data.event.Idevenement;
                document.getElementById('editEventName').value = data.event.Nomevenement;
                document.getElementById('editEventLocation').value = data.event.Lieuevenement;
                document.getElementById('editEventDate').value = data.event.Dateevenement;
                document.getElementById('editEventPrice').value = data.event.Prixevenement;
                document.getElementById('editEventPlaces').value = data.event.Placedisponible;

                // Show the edit modal
                document.getElementById('editEventModal').style.display = 'block';
            } else {
                alert('Error fetching event data.');
            }
        })
        .catch(error => {
            alert('Error: ' + error);
        });
}

function closeEditModal() {
    document.getElementById('editEventModal').style.display = 'none';
}
document.getElementById('editEventForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(document.getElementById('editEventForm'));

    fetch('updateEvent.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Event updated successfully!');
            closeEditModal();  // Close the modal
            location.reload();  // Reload the page to reflect the changes
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(error => {
        alert('Error: ' + error);
    });
});
function deleteReservation(cin) {
    // Confirm the deletion
    if (confirm('Are you sure you want to delete this reservation?')) {
        // Use fetch to send the delete request to deleteReservation.php
        fetch('deleteReservation.php?CIN=' + cin)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Reservation deleted successfully!');
                    // Reload the page to reflect the change
                    location.reload();
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => {
                alert('Error: ' + error); // Handle any errors
            });
    }
}
    </script>
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