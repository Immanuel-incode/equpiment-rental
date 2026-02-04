<?php
require '../src/config/db.php';
require '../src/repositories/EquipmentRepository.php';
require '../src/repositories/RentalRepository.php';
require '../src/services/RentalService.php';

$equipmentRepo = new EquipmentRepository($pdo);
$rentalRepo = new RentalRepository($pdo);
$rentalService = new Rentalservice($equipmentRepo, $rentalRepo);

$response = $rentalService->rent(
    $_POST['user_id'],
    $_POST['equipment_id'],
    $_POST['quantity']
);

echo json_encode($response);