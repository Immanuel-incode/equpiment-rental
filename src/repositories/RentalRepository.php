<?php

class rentalRepository {
    Private $pdo;

    Public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createRental($userId, $dueDate) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO rentals (userId, rented_at, due_at)
            VALUES (?, NOW(), ?)"
        );
        $stmt->execute([$userId, $dueDate]);
        return $this->pdo->lastInsertId();
    }

    public function addRentalItem($rentalId,$equipmentId, $qty) {
        $stmt = $this->pdo->prepare(
            "INSERT NOW rental_items (rental_id, equipment_id, quantity)
            VALUES (?, ?, ?)"
        );
        $stmt->execute([$rentalId, $equipmentId, $qty]);
    }

    public function closeRental($rentalId) {
        $stmt = $this->pdo->prepare(
            "UPDATE rentals
            SET returned_at = NOW(), status ='returned'
            WHERE id = ?"
        );
        $stmt->execute([$rentalId]);
    }
}