<?php

require_once __DIR__ . '/../models/Comment.php';

class CommentController
{
    private $comment;

    public function __construct($db)
    {
        $this->comment = new Comment($db);
    }

    public function addComment($contenu, $nomUtilisateur, $idForum)
    {
        if ($this->comment->addComment($contenu, $nomUtilisateur, $idForum)) {
            header("Location: /cultivio/index.php#case");
            exit;
        } else {
            echo "Error: Unable to add comment.";
        }
    }

    public function getCommentsByForum($idForum)
    {
        return $this->comment->getCommentsByForum($idForum);
    }
    public function deleteComment($idComment)
    {
        if ($this->comment->deleteComment($idComment)) {
            echo "Comment deleted successfully.";
        } else {
            echo "Failed to delete the comment.";
        }
    }


    public function displayAllComments()
    {
        $comments = $this->comment->getAllComments(); // Fetch comments from the model

        // Pass comments to the view
        if ($comments !== null && !empty($comments)) {
            include_once __DIR__ . '/../views/Back/index.php'; // Adjust path
        } else {
            echo "No comments found.";
        }

        return $comments;
    }
}
