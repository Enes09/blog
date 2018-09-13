<?php 
class Post {

	public $_title;
	public $_content;

	public function __construct($title,$content){

		$this->setTitle($title);
		$this->setContent($content);
	}

	public function setTitle($title){

		if (strlen($title) < 255 )
			{
				$this->_title = $title;
			}
		else
			{
				throw new Execpetion ("Le titre de votre billet doit être plus court.");
			}
	}

	public function setContent($content){

		$this->_content = $content;
	}

	public function dbConnect (){

		$db = new PDO ('mysql:host=localhost;dbname=blog','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		return $db;
	} 

	public function create(){

		$db = $this->dbConnect();
		$prepare = $db->prepare('INSERT INTO posts (title,content,post_date) VALUES (?, ?, NOW())');
		$post = $prepare->execute(array($this->_title, $this->_content));

		return $post;

	}

	public function delete (){

		$db = $this->dbConnect();
		$prepare = $db->prepare('DELETE FROM posts WHERE title=?');
		$postDelete = $prepare->execute(array($this->_title));
		
		return $postDelete; 

	}
}

