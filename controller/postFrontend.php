<?php
require('model/Post.php');
require('model/Comments.php');
require('model/Users.php');


function  postsList(){

	$post = new Post("init", "init");
	$listOfPost = $post->postList();
	
	require('view/frontendPostsListView.php');
}



