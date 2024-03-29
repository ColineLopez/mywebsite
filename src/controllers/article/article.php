<?php

namespace MyWebsite\Controllers\Article\Article; 

require_once('src/lib/database.php');
require_once('src/model/post.php');
require_once('src/model/comment.php');

use MyWebsite\Lib\Database\DatabaseConnection;
use MyWebsite\Model\Post\PostRepository;
use MyWebsite\Model\Comment\CommentRepository;

/**
 * class that allows to get an article and their comments
 */
class Article
{
	/**
     * function to get an article and their comments
     * 
     * @param string $postID ID of the article we want to get
     */
	public function execute(string $postID) : void
	{
		$connection = new DatabaseConnection();

		$postRepository = new PostRepository();
		$postRepository->connection = $connection;
		$post = $postRepository->getPost($postID);

		$commentRepository = new CommentRepository();
		$commentRepository->connection = $connection;
		$comments = $commentRepository->getComments($postID);

		require('templates/article.php');
	}
}
