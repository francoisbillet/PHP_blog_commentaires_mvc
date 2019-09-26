<?php
require('model/model.php');

function listPosts() {
	$posts = getPosts();

	require('view/listPostsView.php');
}

function post() {
	$post = getPost($_GET['id']);
	$comments = getComments($_GET['id']);

	require('view/postView.php');
}

function addComment($post_id, $author, $comment) {
	$affectedLines = postComment($post_id, $author, $comment);
	if ($affectedLines == false) {
		throw new Exception('Impossible d\'ajouter le commentaire');
	}
	else {
		header('Location: index.php?action=post&id=' . $post_id);
	}
}

function modifyComment($post_id, $comment_id, $comment) {
	$modifyComment = updateComment($comment_id, $comment);
	if (!$modifyComment) {
		throw new Exception('Impossible de modifier le commentaire');
	}
	else {
		header('Location: index.php?action=post&id=' . $post_id);
	}
}

function comment() {
	$post = getPost($_GET['id']);
	$comment = getComment($_GET['comment_id']);
	require('view/modifyCommentView.php');
}