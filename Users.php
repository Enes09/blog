<?php 
require('Comments.php');
require('Post.php');

class Administrator extends Post {

	public $_login;
	public $_password;
	

	public function dbConnect (){

		$db = new PDO ('mysql:host=localhost;dbname=blog','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		return $db;
	} 

	public function passControl (){

		$db = $this->dbConnect();
		$prepare = $db->prepare('SELECT login, password FROM users WHERE login = :login ');
		$passControl = $prepare->execute(array('login'=>$this->_login));

		return $passControl;
	}

	public function connection (){
		session_start();
		$_SESSION['login'] = $this->_login;
		$_SESSION['password'] = $this->_password;
	}



} 