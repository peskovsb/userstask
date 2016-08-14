<?php
class Database {
	//-----DB params------
	private $host;
	private $user;
	private $password;
	private $db;
	
	//------***----------
   public $connection;

   public function __construct($host,$user,$password,$db) {
	$this->host = $host;
	$this->db = $db;
	$this->user = $user;
	$this->password = $password;
		try {
			$options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			); 
			$this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->user, $this->password, $options);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
   }
}
$db = new Database('localhost','root','','userstask');
?>