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
		$prepare = $db->prepare('INSERT INTO posts (title,content,post_date,last_update_date) VALUES (?, ?, NOW(), NOW())');
		$post = $prepare->execute(array($this->_title, $this->_content));

		return $post;

	}

	public function delete (){

		$db = $this->dbConnect();
		$prepare = $db->prepare('DELETE FROM posts WHERE title=?');
		$postDelete = $prepare->execute(array($this->_title));
		
		return $postDelete; 

	}

	public function update (){

		$db = $this->dbConnect();
		$prepare = $db->prepare('UPDATE posts SET title= ?, content= ?, last_update_date= NOW()');
		$update = $prepare->execute(array($this->_title, $this->_content));

		return $update;

	}

	public function postList(){

		$db = $this->dbConnect();
		$postList = $db->query('SELECT id,title, content, post_date, last_update_date FROM posts ORDER BY id DESC ');

		return $postList;

		#la partie en dessous devra être effectuer dans la vue

		#while($data = $postList->fetch()){
		#	echo "<p>" . $data['title'] . $data['content']. $data['post_date']. $data['last_update_date']. "</p> ";
		#}

	}

	public function display ($postId){
		# ce diplay permet d'afficher un seul id pour éventuellement voir les commentaires en dessous de celui-ci

		$db = $this->dbConnect();
		$prepare = $db->prepare('SELECT title, content FROM posts WHERE id=?');
		$postList = $prepare->execute(array($postId))

		return $postList;


		# fetch en vue ...
		#while($data = $postList->fetch()){
		#	echo "<p>" . $data['title'] . $data['content'] ."</p> ";
		#}
	}

	
}

