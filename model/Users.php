<?php 
class Administrator {

	public $_login;
	public $_password;
	

	public function __construct($login, $password){

		$this->setLogin($login);
		$this->setPassword($password);
	}

	public function setLogin ($login){

		if(strlen($login) <= 255)
			{
				$this->_login = $login;
			}
		else
			{
				throw new Exception("Le login ou le mot de passe est incorrecte.");
				
			}
		
	}

	public function setPassword ($password){
		if(strlen($password))
			{
				$this->_password = $password;
			}
		else
			{
				throw new Exception("Le login ou le mot de passe est incorrecte.");
				
			}
		
	}


	public function dbConnect (){

		$db = new PDO ('mysql:host=localhost;dbname=blog','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		return $db;
	} 

	public function passControl (){

		$db = $this->dbConnect();
		$passControl = $db->prepare('SELECT login, password FROM users WHERE login = :login ');
		$passControl->execute(array('login'=>$this->_login));

		$data = $passControl->fetch();
	

		return $data;
		#verification au niveau du controller
	}

	public function connection (){

		#session_start();
		$_SESSION['login'] = $this->_login;
		$_SESSION['Password'] = $this->_password;

	}

	public function cookie (){

		setcookie('login', $this->_login, time() + 365*24*3600, null, null, false, true);
		setcookie('password', $this->password, time() + 365*24*3600, null, null, false, true);

	}

	public function disconnection (){

		$_SESSION = array();
		session_destroy();

	}

	public function cancelAuto(){

		$_SESSION = array();
		session_destroy();
		setCookie('blogLogin', '', time() );
		setCookie('blogPassword', '', time() );

	}

	public function tableCookie($hashIp, $login){

		$db = $this->dbConnect();
		$ipControl = $db->prepare('INSERT INTO auto_connection (ip_cookie, login_cookie) VALUES (?,?)');
		$ipControl->execute(array($hashIp, $login));

		return $ipControl;
	}

	public function cookieControl(){

		$db = $this->dbConnect();
		$cookieControl = $db->query('SELECT ip_cookie, login_cookie FROM auto_connection');

		return $cookieControl;

	}

} 


