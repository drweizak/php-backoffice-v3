<?php
class database {
	
	private $server = 'localhost';
	private $username = 'root';
	private $password = '';
	private $bd = 'ninpotoronto';
	private $myDb = null;
	
	public function __construct() {
		$this->myDb = new mysqli($this->server, $this->username, $this->password, $this->bd);
	
		if (mysqli_connect_error()){
			$_SESSION['msg']='There was an error with the Database Server Connection! We are sorry. Please, Try again or contact Shape Web Solutions';
			$_SESSION['msg_type']='warning';	
		}
		
		if (!$this->myDb->set_charset("utf8")) {
		}
	}
	
	public function requestQuery($query){
		
		if($resultado = $this->myDb->query($query)){
			
			return($resultado);
		}
		else {
			$_SESSION['msg']='There was an error with the Database Server Query! We are sorry. Please, Try again or contact Shape Web Solutions<br/>'.$query;
			$_SESSION['msg_type']='warning';
		}
	}
}
?>