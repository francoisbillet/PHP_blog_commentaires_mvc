<?php
function getPosts() {
	$db = dbConnect();
	$request = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

	return $request;
}

function getPost($post_id) {
	$db = dbConnect();
	$request = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %HH%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
	$request->execute(array($post_id));
	$post = $request->fetch();

	return $post;
}

function getComments($post_id) {
	$db = dbConnect();
	$comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
	$comments->execute(array($post_id));

	return $comments;
}

function getComment($comment_id) {
	$db = dbConnect();
	$request = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
	$request->execute(array($comment_id));
	$comment = $request->fetch();

	return $comment;
}


function postComment($post_id, $author, $comment) {
	$db = dbConnect();
	$request = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
	$affectedLines = $request->execute(array($post_id, $author, $comment));

	return $affectedLines;
}

function updateComment($comment_id, $comment) {
	$db = dbConnect();
	$request = $db->prepare('UPDATE comments SET comment = ? WHERE id = ?');
	$updateComment = $request->execute(array($comment, $comment_id));

	return $updateComment;
}

function dbConnect() {
	$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
	return $db;
}
