<?php

namespace App\Factories\SalesOrder;

use App\Factories\SalesOrder\SetInterface;
use DB;

class Factory implements SetInterface
{

    public function getindex()
    {
        $results = DB::select("
        SELECT o.id,
            o.so_number,
            o.so_date,
            s.name AS customer,
            CONCAT(e.firstname,' ',e.middlename,'. ',e.lastname) AS sales_agent,
            o.total_sales,
            o.status
        FROM sales_order o
        INNER JOIN customers s
        ON o.customer_id = s.id
        INNER JOIN employees e
        ON o.employee_id = e.id
        ORDER BY o.id DESC");

        return collect($results);
    } 

    public function getSONo()
    { 
    $orderObj = DB::table('sales_order')->select('so_number')->latest('id')->first();
   
    $yr = date('Y');
    if ($orderObj) {
        $orderNr = $orderObj->so_number;
        $removed1char = substr($orderNr, 4);
        $generateOrder_nr = $stpad = $yr. str_pad($removed1char + 1, 5, "0", STR_PAD_LEFT);
        //$generateOrder_nr = $stpad = str_pad($removed1char + 1, 5, "0", STR_PAD_LEFT);
      } else {
          $generateOrder_nr = $yr. str_pad(1, 5, "0", STR_PAD_LEFT);
      }
      return $generateOrder_nr;    
     }
  
    public function getInventoryItems($id)
    {
        $results = DB::select("
            SELECT i.id,
                    e.id AS item_id,
                     e.name AS item_name,
                     e.description,
                     CONCAT(i.unit_quantity,' - ',u.code) AS untis,
                    i.unit_quantity,
                     i.onhand_quantity,
                     e.srp,
                     i.status
            FROM  items e
            LEFT JOIN  inventory i ON i.item_id = e.id
            LEFT JOIN unit_of_measure u ON u.id = e.unit_id 
            WHERE e.deleted_at IS NULL AND i.location = ? AND i.consumable = 0;",[$id]);

        return collect($results);

    }

    public function getCSitems($cs)
    {
        $results = DB::select("
            SELECT  c.item_id,
                    i.name AS item_name,
                    i.description,
                    u.code AS units,
                    i.srp,
                    ifnull(c.srp_discounted,0) as dis_amount,
                    ifnull(c.percentage_discount,0) as dis_percent,
                    c.set_srp
            FROM customer_prices c
            INNER JOIN items i ON c.item_id = i.id
            INNER JOIN unit_of_measure u ON u.id = i.unit_id
            WHERE c.customer_id = ? AND activated_discount = 1",[$cs]);

        return collect($results);

    }

   public function getSetItems($id)
    {
        $results = DB::select("
            SELECT  i.id as item_id,
                    i.name AS item_name,
                    i.description,
                    u.code AS units,
                    i.srp,
                    '0.00' AS  dis_amount,
                    '0.00' AS dis_percent,
                    i.srp as set_srp
            FROM items i 
            INNER JOIN unit_of_measure u ON u.id = i.unit_id
            WHERE i.id = ?;",[$id]);

        return collect($results);

    }
}
