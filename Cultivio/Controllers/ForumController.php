<?php

require_once __DIR__ . '/../models/Forum.php';

class ForumController
{
    private $forum;

    public function __construct($db)
    {
        $this->forum = new Forum($db);
    }

    public function addForum($contenu, $sujetForum, $nomUtilisateur)
    {
        // Call the model's method to insert the new forum
        $result = $this->forum->addForum($contenu, $sujetForum, $nomUtilisateur);

        return $result; // Return the result to indicate success or failure
    }


    public function displayAllForums()
    {
        // Get all forums from the model
        $forums = $this->forum->getAllForums();
        // Log forums to the console

        // Check if forums are available
        if ($forums !== null && is_array($forums) && !empty($forums)) {
            // Pass forums to the view
            include_once __DIR__ . '/../views/Back/index.php'; // Adjust to correct path
        } else {
            // Provide an empty array or a message for the view
            $forums = []; // Pass an empty array if no forums found
            include_once __DIR__ . '/../views/Back/index.php'; // Ensure the view handles empty data
        }
        return $forums;
    }

    public function getAllForumsWithComments()
    {
        return $this->forum->getAllForumsWithComments();
    }
    public function incrementLikes($idForum)
    {
        $result = $this->forum->incrementLikes($idForum);
        if ($result) {
            header("Location: /cultivio/index.php?action=home#case");
            exit;
        } else {
            echo "Error: Unable to increment likes.";
        }
    }

    public function deleteForum($idForum)
    {
        if ($this->forum->deleteForum($idForum)) {
            echo "Forum deleted successfully.";
            header("Location: /cultivio/views/back/index.php?action=home#case");
        } else {
            echo "Failed to delete the forum.";
        }
    }
}
