<?php

class Forum
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all forums
    public function getAllForums()
    {
        $sql = "SELECT * FROM forums";  // Fetch all forums
        $result = $this->conn->query($sql);

        $forums = [];
        while ($row = $result->fetch_assoc()) {
            $forums[] = $row;
        }


        return $forums;
    }

    public function deleteForum($idForum)
    {
        $sql = "DELETE FROM forums WHERE IdForum = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idForum);

        if ($stmt->execute()) {
            return true; // Successfully deleted
        } else {
            echo "Error: " . $stmt->error; // For debugging, remove in production
            return false;
        }
    }


    public function addForum($contenu, $sujetForum, $nomUtilisateur)
    {
        $date = date('Y-m-d H:i:s'); // Get current date and time
        $likes = 0; // Default value for likes

        // Insert the forum into the database with the new subject column
        $sql = "INSERT INTO forums (contenu, sujetForum, likes, date, nomUtilisateur) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            // Handle the error if the statement preparation fails
            echo "Error preparing the SQL statement: " . $this->conn->error;
            return false; // Ensure the method returns false in case of failure
        }

        $stmt->bind_param("ssiss", $contenu, $sujetForum, $likes, $date, $nomUtilisateur);

        if ($stmt->execute()) {
            return true; // Success
        } else {
            // Handle the error if the execution fails
            echo "Error: " . $stmt->error;
            return false; // Failure
        }
    }


    public function getAllForumsWithComments()
    {
        $sql = "SELECT 
           forums.IdForum, forums.contenu AS forumContent, forums.likes, forums.date, forums.nomUtilisateur AS forumUser,
           forums.sujetForum,   -- Make sure sujetForum is selected here
           commentaires.IdCommentaire, commentaires.Contenu AS commentContent, commentaires.DatePublication, commentaires.nomUtilisateur AS commentUser
       FROM forums
       LEFT JOIN commentaires ON forums.IdForum = commentaires.IdForum
       ORDER BY forums.likes DESC, forums.date DESC, commentaires.DatePublication ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $forums = [];
        while ($row = $result->fetch_assoc()) {
            $forumId = $row['IdForum'];

            if (!isset($forums[$forumId])) {
                $forums[$forumId] = [
                    'IdForum' => $row['IdForum'],
                    'forumContent' => $row['forumContent'],
                    'sujetForum' => $row['sujetForum'],
                    'likes' => $row['likes'],
                    'date' => $row['date'],
                    'forumUser' => $row['forumUser'],
                    'comments' => []
                ];
            }

            if ($row['IdCommentaire']) { // Only add if there's a comment
                $forums[$forumId]['comments'][] = [
                    'IdCommentaire' => $row['IdCommentaire'],
                    'commentContent' => $row['commentContent'],
                    'DatePublication' => $row['DatePublication'],
                    'commentUser' => $row['commentUser']
                ];
            }
        }

        return $forums;
    }

    // Fetch a specific forum by its ID
    public function getForumById($idForum)
    {
        $sql = "SELECT * FROM forums WHERE IdForum = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idForum);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null; // No forum found with the given ID
        }

        return $result->fetch_assoc(); // Return the forum data as an associative array
    }

    public function incrementLikes($idForum)
    {
        // Increment the likes in the database
        $sql = "UPDATE forums SET likes = likes + 1 WHERE IdForum = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idForum);

        if ($stmt->execute()) {
            return true; // Success
        } else {
            echo "Error: " . $stmt->error;
            return false; // Failure
        }
    }
}
