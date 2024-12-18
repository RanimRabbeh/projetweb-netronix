<?php
include '../../Controller/ReservationsC.php';
include '../../Controller/EvenementsC.php';
$evenementsC = new evenementsC();
$events = $evenementsC->getAllEvents();
$error = "";

$reservation = null;
$reservationC = new ReservationC();  // Use the ReservationC controller

// Check if reservation form data is set
if (
   isset($_POST["nom"]) && $_POST["prenom"] && $_POST["cin"] && $_POST["nomEvenement"] && $_POST["dateEvenement"] && $_POST["baggage"] && $_POST["evenid"]
) {
   // Check if all the form fields are not empty
   if (
       !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["cin"]) && !empty($_POST["nomEvenement"]) && !empty($_POST["dateEvenement"]) && !empty($_POST["baggage"]) && !empty($_POST["evenid"])
   ) {
       // Create a new Reservation object with the form data
       $reservation = new Reservation(
           $_POST['nom'],
           $_POST['prenom'],
           $_POST['cin'],
           $_POST['nomEvenement'],
           $_POST['dateEvenement'],
           $_POST['baggage'],
           $_POST['evenid'],
       );

       // Call the insertReservation method to add the reservation to the database
       $reservationC->insertReservation($reservation);
   } else {
       $error = "Missing information";  // If any required fields are missing
   }
}
$reservations = $reservationC->getAllReservations();
// Assuming you have the SubscriptionModel class with the getSubscriptionCounts method
$reservationsCounts = $reservationC->getReservationsCounts();
$totalReservations = array_sum(array_column($reservationsCounts, 'reservations_count')); // Get the total number of subscriptions

// Calculate the percentage for each subscription type
$reservationsWithPercentage = [];
foreach ($reservationsCounts as $reservation) {
    $percentage = ($reservation['reservations_count'] / $totalReservations) * 100;
    $reservationsWithPercentage[] = [
        'eventname' => $reservation['eventname'],
        'reservations_count' => $reservation['reservations_count'],
        'percentage' => round($percentage, 2),  // Rounded to 2 decimal places
    ];
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/winwheeljs@2.7.0/dist/Winwheel.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
</head>
<body>
    <header>
    <nav>
    <div class="nav-left">
        <img src="assets/images/log.png" alt="Logo" class="logo">
    </div>
    <ul class="menu">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="#events">Événements</a></li>
        <li><a href="#boutique">Boutique</a></li>
        <li><a href="avis-front.php">Forum</a></li>
        <li><a href="index.php#pricing">Réclamations</a></li>
    </ul>
    <div class="nav-right">
        <button class="login-btn">Se connecter</button>
    </div>
</nav>


    </header>

    <main>
        <section class="events-section">
<div class="container-fluid service pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h1 class="text-primary">Les Evénements</h1>
        </div>
        <div class="row g-4">
            <?php 
            // Check if there are events to display
            if (!empty($events)) {
                foreach ($events as $event) {
                    // Determine the image path (default image if eventimage is empty)
                    $imagePath = !empty($event['eventimage']) ? '../uploads/' . htmlspecialchars($event['eventimage']) : 'img/default-event.jpg';
            
                    // Loop through each event and create an HTML card
                    echo '
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="' . $imagePath . '" class="img-fluid rounded-top w-100" alt="Event Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4">' . htmlspecialchars($event['Nomevenement']) . '</a>
                                <p class="mb-4">Reservez pour cet evenement avant   ' . htmlspecialchars($event['Dateevenement']) . '</p>
                                <p class="mb-4">Places Disponibles :  ' . htmlspecialchars($event['Placedisponible']) . '</p>
                                <p class="mb-4">Prix  :  ' . htmlspecialchars($event['Prixevenement']) . '</p>
                                <button class="btn-reserve-now btn btn-primary rounded-pill py-2 px-4" 
                        data-event-name="' . htmlspecialchars($event['Nomevenement']) . '" 
                        data-event-date="' . htmlspecialchars($event['Dateevenement']) . '"
                        data-event-Id="' . htmlspecialchars($event['Idevenement']) . '">Réservez maintenant</button>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No events available at the moment.</p>";
            }
            ?>
            
        </div>
    </div>
</div>
<div class="spin-the-wheel-container text-center my-5">
    <h2>Tourner la roue pour gagner des remises !</h2>
    <canvas id="spinWheel" width="400" height="400"></canvas>
    <button id="spinButton" class="btn btn-success mt-3">Tourner</button>
    <p id="spinResult" class="mt-3"></p>
</div>


<h1 class="res">Statistiques des reservations </h1>
<canvas id="reservationChart"></canvas>
<style>
    .res{
        margin: auto;
  width: 50%;

  padding: 10px;
    }
    #reservationChart {
        width: 100px;   /* Set the width */
        height: 100px;  /* Set the height */
    }
</style>
<!-- Modal HTML Structure -->
<div id="reservationModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Réservation</h2>
        <form id="reservationForm"  method="POST" action="submit_reservation.php">
            <input type="hidden" name="evenid" id="evenid">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" class="form-control">
                <span class="error-message" id="nom-error"></span> <!-- Error message for Nom -->
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" class="form-control">
                <span class="error-message" id="prenom-error"></span> <!-- Error message for Prénom -->
            </div>
            <div class="form-group">
                <label for="cin">CIN (Carte d'Identité Nationale):</label>
                <input type="text" id="cin" name="cin" class="form-control">
                <span class="error-message" id="cin-error"></span> <!-- Error message for CIN -->
            </div>
            <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" class="form-control" >
    <span class="error-message" id="email-error"></span> <!-- Error message for Email -->
</div>
            <div class="form-group">
                <label for="nomEvenement">Nom de l'événement:</label>
                <input type="text" id="nomEvenement" name="nomEvenement" readonly>
            </div>
            <div class="form-group">
                <label for="dateEvenement">Date de l'événement:</label>
                <input type="text" id="dateEvenement" name="dateEvenement" readonly>
            </div>
            <div class="form-group">
                <label for="baggage">Baggage:</label>
                <input type="text" id="baggage" name="baggage" class="form-control">
                <span class="error-message" id="baggage-error"></span> <!-- Error message for Baggage -->
            </div>
            <button type="submit" class="btn">Réserver</button>
        </form>
    </div>
</div>
<!-- Confirmation Modal HTML Structure -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeConfirmationModal">&times;</span>
        <h2 class="modal-title">Reservation Confirmed</h2>
        <p class="confirmation-message">Thank you for your reservation! We have Sent you an email for the confirmation . Below are your reservation details:</p>
        <p><strong>Nom:</strong> <span id="confirmationNom"></span></p>
        <p><strong>Prénom:</strong> <span id="confirmationPrenom"></span></p>
        <p><strong>CIN:</strong> <span id="confirmationCIN"></span></p>
        <p><strong>Nom de l'événement:</strong> <span id="confirmationEventName"></span></p>
        <p><strong>Date de l'événement:</strong> <span id="confirmationEventDate"></span></p>
        <p><strong>Baggage:</strong> <span id="confirmationBaggage"></span></p>
        <button id="printReservation" class="btn">Imprimer</button>
    </div>
</div>


        </section>
    </main>

    <script>
      // Get modal element
var modal = document.getElementById("reservationModal");

// Get the button that opens the modal
var btns = document.querySelectorAll(".btn-reserve-now");

// Get the <span> element that closes the modal
var closeBtn = document.querySelector(".close-btn");

// When the user clicks on the "Reservez maintenant" button, open the modal
btns.forEach(function(btn) {
    btn.addEventListener("click", function() {
        // Get event details from the button's parent card
        var eventName = this.getAttribute("data-event-name");
        var eventDate = this.getAttribute("data-event-date");
        var eventid = this.getAttribute("data-event-Id");

        // Set the event name and date in the modal form
        document.getElementById("nomEvenement").value = eventName;
        document.getElementById("dateEvenement").value = eventDate;
        document.getElementById("evenid").value =eventid;

        // Show the modal
        modal.style.display = "block";
    });
});

// When the user clicks on <span> (x), close the modal
closeBtn.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
document.getElementById("reservationForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission to handle validation

    // Clear any previous error messages
    const errorMessages = document.querySelectorAll(".error-message");
    errorMessages.forEach(function(error) {
        error.textContent = "";
    });

    let isValid = true;

    // Get values
    const nom = document.getElementById("nom").value;
    const prenom = document.getElementById("prenom").value;
    const cin = document.getElementById("cin").value;
    const baggage = document.getElementById("baggage").value;
    const eventName = document.getElementById("nomEvenement").value;
    const eventDate = document.getElementById("dateEvenement").value;
    const email = document.getElementById("email").value;

    // Validation logic
    const nomRegex = /^[A-Za-zÀ-ÿ\s]+$/;
    const prenomRegex = /^[A-Za-zÀ-ÿ\s]+$/;
    const cinRegex = /^[0-9]+$/;

    // Validate Nom
    if (nom.length < 1 || nom.length > 50 || !nomRegex.test(nom)) {
        document.getElementById("nom-error").textContent = "Nom should be between 1-50 characters and contain no special characters.";
        isValid = false;
    }

    // Validate Prenom
    if (prenom.length < 1 || prenom.length > 50 || !prenomRegex.test(prenom)) {
        document.getElementById("prenom-error").textContent = "Prénom should be between 1-50 characters and contain no special characters.";
        isValid = false;
    }

    // Validate CIN
    if (!cinRegex.test(cin)) {
        document.getElementById("cin-error").textContent = "CIN should contain only numeric values.";
        isValid = false;
    }

    // Validate Baggage
    if (!/^[0-9]+$/.test(baggage)) {
        document.getElementById("baggage-error").textContent = "Baggage should be a numeric value.";
        isValid = false;
    }
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
if (!emailRegex.test(email)) {
    document.getElementById("email-error").textContent = "Please enter a valid email address.";
    isValid = false;
}

    // If validation passes, send the form data to the server
    if (isValid) {
        const formData = new FormData(document.getElementById("reservationForm"));

        fetch('submit_reservation.php', {
            method: 'POST',
            body: formData // Send form data to the backend
        })
        .then(response => response.json())
        .then(data => {
            // Handle server response
            if (data.success) {
                // Populate the confirmation modal with the reservation details
                document.getElementById("confirmationNom").textContent = nom;
                document.getElementById("confirmationPrenom").textContent = prenom;
                document.getElementById("confirmationCIN").textContent = cin;
                document.getElementById("confirmationEventName").textContent = eventName;
                document.getElementById("confirmationEventDate").textContent = eventDate;
                document.getElementById("confirmationBaggage").textContent = baggage;

                // Show the confirmation modal
                confirmationModal.style.display = "block";
                closeModal();  // Close the reservation modal
            } else {
                alert('Error: ' + data.message); // Show error message returned by PHP
            }
        })
        .catch(error => {
            alert('Error: ' + error); // Handle any errors with the request
        });
    }
});

// Close the reservation modal
function closeModal() {
    reservationModal.style.display = "none"; // Hide the reservation modal
}

// Close the confirmation modal when user clicks the close button
closeConfirmationModal.addEventListener("click", function() {
    confirmationModal.style.display = "none"; // Close the confirmation modal
});

// Add the print functionality
document.getElementById("printReservation").addEventListener("click", function() {
    window.print(); // This will trigger the print dialog for the page
});
</script>
<script>
        // Chart.js Integration
const reservationsWithPercentage = <?php echo json_encode($reservationsWithPercentage); ?>;

// Extract data
const eventname = reservationsWithPercentage.map((reservation) => reservation.eventname);
const reservationPercentages = reservationsWithPercentage.map((reservation) => reservation.percentage);

// Create Chart
const ctx = document.getElementById("reservationChart").getContext("2d");
const reservationChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: eventname,
        datasets: [
            {
                label: "Reservation  Type Percentage",
                data: reservationPercentages,
                backgroundColor: ["#2b452f", "#1c1f52", "#52141a", "#c9c175", "#75bbc9"],
            },
        ],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: "top",
            },
            tooltip: {
                callbacks: {
                    label: function (tooltipItem) {
                        return tooltipItem.label + ": " + tooltipItem.raw.toFixed(2) + "%";
                    },
                },
            },
        },
    },
});

</script>
<script>
    // Initialize the spinning wheel
    const wheel = new Winwheel({
        'canvasId': 'spinWheel',
        'numSegments': 7, // Number of segments
        'outerRadius': 170, // Adjust size
        'segments': [
            { 'fillStyle': '#2b452f', 'text': '0%' },
            { 'fillStyle': '#1c1f52', 'text': '5%' },
            { 'fillStyle': '#52141a', 'text': '10%' },
            { 'fillStyle': '#c9c175', 'text': '15%' },
            { 'fillStyle': '#75bbc9', 'text': '20%' },
            { 'fillStyle': '#a474b3', 'text': '25%' },
            { 'fillStyle': '#b37674', 'text': '30%' }
        ],
        'textFontSize': 16,
        'textAlignment': 'outer',
        'animation': {
            'type': 'spinToStop',
            'duration': 5,
            'spins': 8,
            'callbackFinished': segmentWon // Function called when spin stops
        }
    });

    // Start spinning on button click
    document.getElementById('spinButton').addEventListener('click', () => {
        wheel.startAnimation();
    });

    // Handle the result
    function segmentWon(segment) {
        const discount = parseInt(segment.text.replace('%', '')) || 0;
        document.getElementById('spinResult').textContent = `Felicitations ! Vous avez gange une remise de ${discount}% ! `;
        updateEventPrices(discount);
    }

    // Update prices
    function updateEventPrices(discount) {
        const priceElements = document.querySelectorAll('.service-item p:nth-child(4)');
        priceElements.forEach(priceElement => {
            const originalPrice = parseFloat(priceElement.textContent.split(': ')[1].replace('$', ''));
            const discountedPrice = (originalPrice * (1 - discount / 100)).toFixed(2);
            priceElement.textContent = `For only : ${discountedPrice}$`;
        });
    }
</script>
<style>
   .spin-the-wheel-container {
    text-align: center;
    margin-top: 50px;
}

#spinWheel {
    margin: 0 auto;
    border: 5px solid #ccc;
    border-radius: 50%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

#spinResult {
    font-size: 1.2rem;
    font-weight: bold;
    color: #4caf50;
}

</style>
</body>
</html>
