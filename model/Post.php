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

	public function delete ($postId){

		$db = $this->dbConnect();
		$postDelete = $db->prepare('DELETE FROM posts WHERE id=?');
		$postDelete->execute(array($postId));

		$commentDelete = $db->prepare('DELETE FROM comments WHERE post_id=?');
		$commentDelete->execute(array($postId));
		
		return $postDelete; 

	}

	public function update ($postId){

		$db = $this->dbConnect();
		$update = $db->prepare('UPDATE posts SET title= ?, content= ?, last_update_date= NOW() WHERE id= ?');
		$update->execute(array($this->_title, $this->_content, $postId));

		return $update;

	}

	public function postList($page, $postPerPage){
 
		$db = $this->dbConnect();
		
		$totalPost=$db->query('SELECT COUNT(id) AS total FROM posts');
		$totalData=$totalPost->fetch();
		$total=$totalData['total'];
		
		#$postPerPage=3;
	
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
	
						$postList = $db->prepare('SELECT id,title, content, post_date, last_update_date FROM posts ORDER BY post_date DESC LIMIT :beginning , :ending  ');
						$postList->bindParam(':beginning', $firstEnter, PDO::PARAM_INT );
						$postList->bindParam(':ending', $postPerPage, PDO::PARAM_INT );
						$postList->execute();

		return [$postList,$totalPage,$actualPage];
				

	}

	public function display ($postId){

		# ce diplay permet d'afficher un seul id pour éventuellement voir les commentaires en dessous de celui-ci

		$db = $this->dbConnect();
		$displayPost = $db->prepare('SELECT title, content, post_date, id, last_update_date FROM posts WHERE id= ?');
		$displayPost->execute(array($postId));

		return $displayPost;

		

	}

	public function checkPost ($postId){

		$db = $this->dbConnect();
		$postNumber = $db->prepare('SELECT COUNT(id) FROM posts WHERE id=?');
		$postNumber->execute(array($postId));

		$data = $postNumber->fetch();
		echo $data[0];

		if($data[0]){
			
			return true;
		}
		else{
			
			return false;
		}
	}
	
}
/*
$test = new Post("init", "init");
$deney = $test->postList(1,3);
while($data = $deney->fetch()){
	echo "<div style='border:solid;'>";
	echo $data['title']."<br/>";
	echo $data['content']."<br/>";
	echo $data['post_date']."<br/>";
	echo "</div>";

}
*/