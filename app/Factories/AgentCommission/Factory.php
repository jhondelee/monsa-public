<?php

namespace App\Factories\AgentCommission;

use App\Factories\AgentCommission\SetInterface;
use DB;

class Factory implements SetInterface
{

    public function getsalesCom($empId)
    {

     $results = DB::select("
                SELECT so.so_number,
			 	 so.status,
				 CONCAT(sub.firstname ,' ',sub.lastname ) AS sub_agent,
		 		 so.total_sales
		FROM sales_order so
		INNER  JOIN employees sub ON sub.id = so.sub_employee_id
		WHERE so.employee_id = ? AND so.status = 'POSTED';",[$empId]);
     
        return collect($results);
    } 
}


