<?php

class Comment
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get comments for a specific forum
    public function getCommentsByForum($idForum)
    {
        $sql = "SELECT * FROM commentaires WHERE IdForum = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idForum);
        $stmt->execute();
        $result = $stmt->get_result();

        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }

        return $comments;
    }

    // Add a new comment
    public function addComment($contenu, $nomUtilisateur, $idForum)
    {
        $sql = "INSERT INTO commentaires (Contenu, nomUtilisateur, IdForum) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $contenu, $nomUtilisateur, $idForum);

        return $stmt->execute();
    }

    public function deleteComment($idComment)
    {
        $sql = "DELETE FROM commentaires WHERE IdCommentaire = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idComment);

        if ($stmt->execute()) {
            return true; // Successfully deleted
        } else {
            echo "Error: " . $stmt->error; // For debugging, remove in production
            return false;
        }
    }


    public function getAllComments()
    {
        $sql = "SELECT * FROM commentaires ORDER BY DatePublication DESC";
        $result = $this->conn->query($sql);

        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }

        return $comments;
    }
}
