<?php
require_once '../../config.php';
require_once '../../Model/Subject.php';

class SubjectC {

    // Method to delete a subject
    public function deleteSubject($subjectId) {
        $pdo = Config::getConnexion();
        $sql = "DELETE FROM subjects WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $subjectId, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Method to update a subject
    public function updateSubject($subjectId, $newName) {
        $pdo = Config::getConnexion();
        $sql = "UPDATE subjects SET name = :name WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $subjectId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $newName, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>