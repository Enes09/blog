<?php
class Comment {

	public $_author;
	public $_content;
	public $_post_id;
	public $_id;


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

	public function delete($id){

		$db = $this->dbConnect();
		$deleteComment = $db->prepare('DELETE FROM comments WHERE id = ?');
		$deleteComment->execute(array($id));

		return $deleteComment;

	}

	public function listComment($postId){

		$db = $this->dbConnect();
		$commentList = $db->query('SELECT author, content, comment_date, id  FROM comments WHERE post_id = ' .$postId.' ORDER BY id DESC');
		
		#while($data = $commentList->fetch()){

			#echo "<p>". $data['author'].' '.$data['content'].' '.$data['comment_date'] .' '.$data['id']. "</p>";
	
		#}

		return $commentList;

	}

	public function alert($id){

		$db = $this->dbConnect();
		$data = $db->query('SELECT validation FROM comments WHERE id = '.$id);
		$checkValidation = $data['validation'];


		if($checkValidation > 0)
			{

				$alert = $db->query('UPDATE comments SET alert = alert + 1 WHERE id = '.$id);

			}
		else
			{
				throw new Exception("La vérification de la possibilité d'alerter ce message a échoué.");
				
			}

		return $alert;

	}

	public function validate($id){
		
		$db = $this->dbConnect();
		$validate = $db->query('UPDATE comments SET validation = 85 WHERE id = '. $id );

		return $validate;
	}

	public function selectComment(){
		$this->_id = $_GET['id'];
	}

}


