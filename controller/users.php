<?php
require_once('database.php');
class users{
	
	public function view($condition, $order, $limit) {
		$database = new database();
		$results = $database->requestQuery("SELECT * FROM users $condition $order $limit");
		
		return($results);
	}
	
	public function add($name, $email, $password){

		$database = new database();

		$query = "INSERT INTO users VALUES('', '$name', '$password', '$email')";
		
		$result = $database ->requestQuery($query);
		
	}
	
	public function editdetails($user_id, $name, $email){
		
		$database = new database();
		
		$query = "UPDATE users SET name='$name', email='$email' WHERE user_id = '$user_id'";
			
		$result = $database ->requestQuery($query);
				
	}
	
	public function editpassword($user_id, $password){
		
		$database = new database();
		
		$query = "UPDATE users SET password='$password' WHERE user_id = '$user_id'";
		
		$result = $database ->requestQuery($query);
				
	}
		
	public function login($email, $password){
		
		$database = new database();

		$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
		$result = $database ->requestQuery($query);
		
		if ($result->num_rows == 1){
			$dados = $result->fetch_assoc();

			session_start();
			$_SESSION['user_id'] = $dados['user_id'];
			$_SESSION['name'] = $dados['name'];
			if($_SESSION['user_id'] == 1){
				$_SESSION['level'] = 1;
			}else{
				$_SESSION['level'] = 2;
			}
			
			header('location: dashboard');
			
		}
		else{
			return("Email or Password are incorrect! Please, try again.");	
		}
		
		
	}
	
	public function delete($user_id){
		
		$database = new database();
		
		$query = "DELETE FROM users WHERE user_id = '$user_id'";
		$result = $database ->requestQuery($query);
	}
}
?>