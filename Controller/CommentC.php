<?php
require_once '../../config.php';
require_once '../../Model/Comment.php';
class CommentC
{
    public static function getAllComments($pdo)
    {
        $stmt = $pdo->query("SELECT * FROM comments");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteComment($id)
    {
        try {
            $pdo = Config::getConnexion();
            $stmt = $pdo->prepare("DELETE FROM comments WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public static function updateComment($pdo, $id, $comment)
{
    $stmt = $pdo->prepare("UPDATE comments SET comment = :comment WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->execute();
}
}
