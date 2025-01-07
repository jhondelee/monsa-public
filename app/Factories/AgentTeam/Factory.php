<?php

namespace App\Factories\AgentTeam;

use App\Factories\AgentTeam\SetInterface;
use DB;

class Factory implements SetInterface
{

	public function index()
	{
		$results = DB::select("SELECT a.employee_id AS id,
				  CONCAT(emp.firstname ,' ',emp.lastname ) AS main_agent,
				  a.created_at
		FROM agent_team a
		INNER JOIN employees emp ON a.employee_id = emp.id
		GROUP BY emp.firstname,emp.lastname,a.employee_id,a.created_at
		ORDER BY a.id desc");

		return collect($results);
	}

}


