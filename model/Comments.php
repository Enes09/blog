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

	public function listComment($postId, $page, $postPerPage){

		$db = $this->dbConnect();

		$totalComments = $db->prepare('SELECT COUNT(id) AS total FROM comments WHERE post_id=?');
		$totalComments->execute(array($postId));
		$totalData=$totalComments->fetch();
		$total=$totalData['total'];

		$totalPage=ceil($total/$postPerPage);

		if($page>0)
			{
				$actualPage = intval($page);

				if($actualPage>$totalPage)
					{
						$actualPage=$totalPage;
					}
			}
		else
			{
				$actualPage=1;
			}

		$firstEnter = ($actualPage-1)*$postPerPage;
		if($firstEnter<0){
			$firstEnter=0;
		}

		$commentList = $db->prepare('SELECT author, content, comment_date, id, validation, alert  FROM comments WHERE post_id =:postId  ORDER BY id DESC LIMIT :beginning , :ending');
		$commentList->bindParam(':postId', $postId, PDO::PARAM_INT );
		$commentList->bindParam(':beginning', $firstEnter, PDO::PARAM_INT );
		$commentList->bindParam(':ending', $postPerPage, PDO::PARAM_INT );
		$commentList->execute();
		
		return [$commentList, $totalPage, $actualPage];
	}

	public function alert($id){

		$db = $this->dbConnect();

		$alert = $db->prepare('UPDATE comments SET alert = alert + 1 WHERE id = ?');
		$alert->execute(array($id));


		return $alert;
	}

	public function validate($id){
		
		$db = $this->dbConnect();
		$validate = $db->prepare('UPDATE comments SET validation = 1 WHERE id = ?');
		$validate->execute(array($id));

		return $validate;
	}

	public function alertedComments($page, $postPerPage){

		$db = $this->dbConnect();

		$totalComments = $db->prepare('SELECT COUNT(id) AS total FROM comments WHERE alert!=?');
		$totalComments->execute(array(0));
		$totalData=$totalComments->fetch();
		$total=$totalData['total'];

		$totalPage=ceil($total/$postPerPage);

		if($page>0)
			{
				$actualPage = intval($page);

				if($actualPage>$totalPage)
					{
						$actualPage=$totalPage;
					}
			}
		else
			{
				$actualPage=1;
			}

		$firstEnter = ($actualPage-1)*$postPerPage;
		if($firstEnter<0){
			$firstEnter=0;
		}


		$alerted = $db->prepare('SELECT author, content, comment_date, id, validation, alert, post_id FROM comments WHERE alert!=0 ORDER BY alert DESC LIMIT :beginning , :ending');
		$alerted->bindParam(':beginning', $firstEnter, PDO::PARAM_INT );
		$alerted->bindParam(':ending', $postPerPage, PDO::PARAM_INT );

		$alerted->execute();

		return [$alerted, $totalPage, $actualPage];
	}

}

