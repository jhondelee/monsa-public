<?php

namespace App\Factories\Inventory;

interface SetInterface {
    
     public function getindex();
     
     public function showlocations($id);

     public function showItem($id);

     public function getconsumables();

      public function getinventory();

     public function InventoryStatusUpdate($inventory_id);

     public function getreturnindex();
}
