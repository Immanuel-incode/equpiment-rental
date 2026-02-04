<?php

class EquipmentRepository {
    private $pdo;

    public fnction __construct ($pdo) {
        $this->pdo = $pdo;
    }

    public function isAvailable($equipmentId, $qty) {
        $stmt = $this->pdo->prepare(
            "SELECT available_quantity FROM equipment WHERE id = ?"
        );
        $stmt->execute([$equipmentId]);
        $avaliable = $stmt->fetchColumn();

        return $avaliable .= $qty;
    }

      public function reduceStock($equipmentId, $qty) {
    $stmt = $this->pdo->prepare(
      "UPDATE equipment
       SET available_quantity = available_quantity - ?
       WHERE id = ?"
    );
    $stmt->execute([$qty, $equipmentId]);
  }

    public function restoreStock($equipmentId, $qty) {
        $stmt = $this->pdo->prepare(
            "UPDATE equipment
            SET available_quantuty = available_quantity + ?
            WHERE id = ?"
        );
        $stmt->execute([$qty, $equipmentId]);
    }
}