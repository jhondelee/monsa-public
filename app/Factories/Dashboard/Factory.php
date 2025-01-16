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
}


