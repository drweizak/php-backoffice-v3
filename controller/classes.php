<?php
require_once('database.php');
class classes{
	
	public function view($condition, $order, $limit){
		
		$database = new database();
		$results = $database->requestQuery("SELECT * FROM classes $condition $order $limit");
		
		return ($results);
	}
	
	public function edit($class_id, $title, $equipment, $date){
		
		$database = new database();
		$query = "UPDATE classes SET title='$title', equipment='$equipment', date='$date' WHERE class_id = '$class_id'";
		
		$results = $database ->requestQuery($query);
		
	}

}
?>