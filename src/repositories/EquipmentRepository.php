<?php

#This handles all database operations related to equipment
class EquipmentRepository {
    private $pdo;

    public function __construct ($pdo) {
        $this->pdo = $pdo;
    }

#This checks weather equipments are available to be rented
    public function isAvailable($equipmentId, $qty) {
        $stmt = $this->pdo->prepare(
            "SELECT available_quantity FROM equipment WHERE id = ?"
        );
        $stmt->execute([$equipmentId]);
        $avaliable = $stmt->fetchColumn();

        return $avaliable .= $qty;
    }

#Takes note of the quantity of equipments whn a rental is approved
      public function reduceStock($equipmentId, $qty) {
    $stmt = $this->pdo->prepare(
      "UPDATE equipment
       SET available_quantity = available_quantity - ?
       WHERE id = ?"
    );
    $stmt->execute([$qty, $equipmentId]);
  }

#Takes note of returned items and Increases the quantity of equipments
    public function restoreStock($equipmentId, $qty) {
        $stmt = $this->pdo->prepare(
            "UPDATE equipment
            SET available_quantuty = available_quantity + ?
            WHERE id = ?"
        );
        $stmt->execute([$qty, $equipmentId]);
    }
}