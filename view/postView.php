<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>

<h1> Mon super blog ! </h1>
<p> <a href="index.php">Retour à la liste des billets</a> </p>

<div class="news">
	<h3> 
		<?= htmlspecialchars($post['title']) ?>
		<em>le <?= $post['creation_date_fr'] ?> </em> 
	</h3>

	<p> 
		<?= nl2br(htmlspecialchars($post['content'])); ?>
	</p>
</div>

<h2> Commentaires </h2>

<form method="post" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>">
	<div>
		<label for="author">Auteur</label><br />
		<input type="text" id="author" name="author" />
	</div>
	<div>
		<label for="comment">Commentaire</label><br />
		<textarea id="comment" name="comment" rows="10" cols="50"></textarea>
	</div>
	<div>
		<input type="submit" />
	</div>
</form>

<?php
while ($comment = $comments->fetch()) {
?>
	<p> <strong><?= htmlspecialchars(($comment['author'])) ?></strong> le <?= $comment['comment_date_fr'] ?> 
		<a href="index.php?action=comment&amp;id=<?= $post['id'] ?>&amp;comment_id=<?= $comment['id'] ?>"> (modifier) </a></p>
	<p> <?= nl2br(htmlspecialchars($comment['comment'])) ?> </p>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>