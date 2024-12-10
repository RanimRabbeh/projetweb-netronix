<?php

require_once __DIR__ . '/controllers/ForumController.php';
require_once __DIR__ . '/controllers/CommentController.php';


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


// Router
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'home':
        // Display all forums with their comments
        $forums = $forumController->getAllForumsWithComments();
        require_once __DIR__ . '/Views/Front/index.html';
        break;

    case 'viewForum':
        // Display a single forum with its comments
        $idForum = $_GET['idForum'] ?? null;
        if ($idForum) {
            $forum = $forumController->getForumById($idForum);
            $comments = $commentController->getCommentsByForum($idForum);
            require_once __DIR__ . '/Views/viewForum.php';
        } else {
            echo "Forum ID not provided.";
        }
        break;

    case 'deleteForum':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idForum = $_POST['idForum'] ?? null;
            if ($idForum) {
                $forumController->deleteForum($idForum);
            }
            // Redirect back to the forum list after deletion
            header("Location: /cultivio/views/back/index.php");
            exit;
        }
        break;

    case 'addForum':
        // Add a new forum
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contenu = $_POST['contenu'] ?? null;
            $sujetForum = $_POST['sujetForum'] ?? null;
            $nomUtilisateur = $_POST['nomUtilisateur'] ?? null;

            if ($contenu && $sujetForum && $nomUtilisateur) {
                // Attempt to add the forum
                $result = $forumController->addForum($contenu, $sujetForum, $nomUtilisateur);

                if ($result) {
                    // Redirect to home if successful
                    header("Location: /cultivio/index.php?action=home");
                    exit;
                } else {
                    echo "Error: Unable to add forum.";
                }
            } else {
                echo "Please provide content, subject, and your name.";
            }
        } else {
            // Load the form for adding a new forum
            require_once __DIR__ . '/Views/addForumForm.php';
        }
        break;

    case 'likeForum':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idForum = $_POST['idForum'] ?? null;
            if ($idForum) {
                $forumController->incrementLikes($idForum);
            } else {
                echo "Forum ID not provided.";
            }
        }
        break;

    case 'deleteComment':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idComment = $_POST['idComment'] ?? null;
            if ($idComment) {
                $commentController->deleteComment($idComment);
            }
            header("Location: /cultivio/views/back/index.php");
            exit;
        }
        break;


    case 'addComment':
        // Add a new comment
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contenu = $_POST['Contenu'];
            $idForum = $_POST['idForum'];
            $nomUtilisateur = $_POST['nomUtilisateur'];
            $commentController->addComment($contenu, $nomUtilisateur, $idForum);
        } else {
            echo "Invalid request.";
        }
        break;

    default:
        echo "Action not found.";
}
