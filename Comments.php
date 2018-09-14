<?php
class Comment {

	public $_author;
	public $_content;
	public $_post_id;



	public function __construct($author, $content, $postId){

		$this->setAuthor($author);
		$this->setContent($content);
		$this->setPostId($postId);

	}

	public function setAuthor($author){

		if ($author < 255 )
			{
				$this->_author = $author;
			}
		else
			{
				throw new Execpetion ("Votre pseudo doit être plus court.");	
			}

	}


	public function setContent($content){

		if ($content < 255 )
			{
				$this->_content = $content;
			}
		else
			{
				throw new Execpetion ("Votre commentaire doit être plus court, vous ne devez pas depasser 255 caractères.");	
			}

	}

	public function setPostId($postId){

		$db = $this->dbConnect();
		$postNumber = $db->query('SELECT COUNT(id) FROM posts');

		if(is_int($postId) || $postId <= $postNumber )
			{
				$this->_post_id = $postId;
			}
		else
			{
				throw new Exception("Le billet correspondant au commentaire n'a pas pu être trouvé.");
			}
	}

	public function dbConnect (){

		$db = new PDO ('mysql:host=localhost;dbname=blog','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		return $db;
	} 

	public function create(){

		$db = $this->dbConnect();
		$prepare = $db->prepare('INSERT INTO comments (author, content, comment_date, post_id, alert, validation) VALUES (?,?,NOW(),?,?,?)');
		$comment = $prepare->execute(array($this->_author, $this->_content, $this->_post_id, 0, 0));

		return $comment;
	}

	public function delete(){

		$db = $this->dbConnect();
		$prepare = $db->prepare('DELETE FROM comments WHERE author = ?');
		$deleteComment = $prepare->execute(array($this->_author));

		return $deleteComment;

	}

	public function listComment($postId){

		$db = $this->dbConnect();
		$commentList = $db->query('SELECT author, content, comment_date FROM comments WHERE post_id = ' .$postId.' ORDER BY id DESC');
		
		while($data = $commentList->fetch()){

			echo "<p>". $data['author'] . $data['content'] . $data['comment_date'] . "</p>";
		}

		return $commentList;

	}

}




$object = new Comment("egzoz borusu faruk", "bugun yine macera pesindeyim", 1);

$object->listComment(1);