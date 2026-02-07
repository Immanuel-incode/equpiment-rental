<?php

#Coordinates repositories and controls the rental workflow
class RentalService {
    private $equipmentRepo;
    private $rentalRepo;

    public function __construct($equipmentRepo, $rentalRepo) {
        $this->equipmentRepo = $equipmentRepo;
        $this->rentalRepo = $rentalRepo;
    }

#applies rental rules which are availability checks, due dates, creates and updates rental records 
    public function rent($userId, $equipmentId, $qty) {
        if (!$this->equipmentRepo->isAvailable($equipmentId, $qty)) {
            return [
                'status' => 'REJECTED',
                'reason' => 'OUT_OF_STOCK'
            ];
        }

        $dueDate = date('Y-m-d H:i:s', strtotime('+7 days'));
        
        $rentalId = $this->rentalRepo->createrental($userId, $dueDate);

        $this->rentalRepo->addRentalItem($rentalId, $equipmentId, $qty);

        $this->rentalRepo->reduceStock($equipmentId, $qty);

        return [
            'status' => 'ACCEPTED',
            'rental_id' => $rentalId
        ];
    } 
}