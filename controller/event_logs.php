<?php
require_once('database.php');
class event_logs{
	
	public function view($select, $condition, $order) {
			$database = new database();
			
			$results = $database->requestQuery("SELECT $select FROM event_logs $condition $order");
			
			return($results);
	}
	
	public function add($date){

		$database = new database();

		$query = "INSERT INTO event_logs VALUES('$date', '1')";
		
		$result = $database ->requestQuery($query);
		
	}
	
	public function edit($date){

		$database = new database();

		$query = "UPDATE event_logs SET visits = visits + 1 WHERE date = '".$date."'";
		
		$result = $database ->requestQuery($query);
		
	}
}
?>