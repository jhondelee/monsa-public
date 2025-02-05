<?php

namespace App\Factories\Dashboard;

use App\Factories\Dashboard\SetInterface;
use DB;

class Factory implements SetInterface
{
    //-- SALES
    public function sales_of_previous_month()
    {
        $results = DB::select("
                    SELECT SUM(total_sales) AS total_sales,
                            DATE_FORMAT(so_date, '%M %Y') AS sales_monthyear
                    FROM sales_order
                    WHERE MONTH(so_date) = MONTH( DATE_ADD(CURRENT_DATE(),INTERVAL -1 MONTH ))
                    AND STATUS ='POSTED' GROUP BY DATE_FORMAT(so_date, '%M %Y')");

        return collect($results);
    }   

    
    public function sales_of_current_month()
    {
        $results = DB::select("
                    SELECT SUM(total_sales) AS total_sales
                    FROM sales_order
                    WHERE MONTH(so_date) = MONTH(CURRENT_DATE())
                    AND STATUS ='POSTED';");

        return collect($results);
    } 


    public function current_year()
    {
        $results = DB::select("SELECT DATE_FORMAT(DATE_ADD(CURRENT_DATE(),INTERVAL -1 MONTH ), '%M %Y') as cur_yr");

        return collect($results);
    }   

    //-- PURCHASE ORDER 
    public function order_of_previous_month()
    {
        $results = DB::select("
                    SELECT SUM(total_amount) AS total_order,
                            DATE_FORMAT(dr_date, '%M %Y') AS order_monthyear
                    FROM incomings
                    WHERE MONTH(dr_date) = MONTH( DATE_ADD(CURRENT_DATE(),INTERVAL -1 MONTH ))
                    AND STATUS ='CLOSED' GROUP BY DATE_FORMAT(dr_date, '%M %Y')");

        return collect($results);
    }   

    
    public function order_of_current_month()
    {
        $results = DB::select("
                    SELECT SUM(total_amount) AS total_order
                    FROM incomings
                    WHERE MONTH(dr_date) = MONTH(CURRENT_DATE())
                    AND STATUS ='CLOSED';");

        return collect($results);
    } 

    public function getinactivecs()
    {
        $results = DB::select("
    SELECT
        c.name AS cs_name,
        MAX(s.so_date) AS so_date,
        CONCAT(DATEDIFF(CURRENT_DATE(),s.so_date),' Days') AS Last_trans,
      CASE 
        WHEN (DATEDIFF(CURRENT_DATE(),s.so_date)  > 14) && (DATEDIFF(CURRENT_DATE(),s.so_date) <= 21) THEN 'No Transaction'
        WHEN (DATEDIFF(CURRENT_DATE(),s.so_date)  > 21) && (DATEDIFF(CURRENT_DATE(),s.so_date) <= 30) THEN 'Follow Up'
        WHEN (DATEDIFF(CURRENT_DATE(),s.so_date)  > 30) THEN 'Lost Customer'
      END AS trans_stat
    FROM sales_order s INNER JOIN customers c ON s.customer_id = c.id
    WHERE (DATEDIFF(CURRENT_DATE(),s.so_date)  < 60) GROUP BY c.name,s.so_date ORDER BY  MAX(s.so_date);");

        return collect($results);
    }
}



