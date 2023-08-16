<?php

namespace MyWebsite\Controllers\Articles;

require_once('src/lib/database.php');
require_once('src/model/post.php');

use MyWebsite\Lib\Database\DatabaseConnection;
use MyWebsite\Model\Post\PostRepository;

class Articles
{
	public function execute()
	{
		$postRepository = new PostRepository();
		$postRepository->connection = new DatabaseConnection();
		$posts = $postRepository->getPosts();

		require('templates/articles_template.php');
	}
}