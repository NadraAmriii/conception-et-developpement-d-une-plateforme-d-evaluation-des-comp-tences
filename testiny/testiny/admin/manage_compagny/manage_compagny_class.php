<?php 

class manage_compagny_class
 {


 	public $host="localhost";
 	public $username="root";
 	public $pass="";
 	public $db_name="uniquedeveloper";
 	public $conn;
 	public $entreprise_list;
 	

 	public function __construct()
 	{
 		$this->conn=new mysqli($this->host,$this->username,$this->pass,$this->db_name);
 		if ($this->conn->connect_errno)
 		 {
 			die("connection failed");
 		}
 	}

 	public function display_courses()
 	{
 		$query="select * from entreprise";
 		$result=$this->conn->query($query);
 		
 		while($row=$result->fetch_array(MYSQLI_ASSOC))
 		{
 			$this->entreprise_list[]=$row;
 		}
 		return $this->entreprise_list;
 	}
}

 ?>