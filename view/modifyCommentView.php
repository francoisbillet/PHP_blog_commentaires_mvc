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

<h2> Modifier commentaire </h2>

<p> <strong><?= htmlspecialchars(($comment['author'])) ?></strong> le <?= $comment['comment_date_fr'] ?> </p>
	<p> <?= nl2br(htmlspecialchars($comment['comment'])) ?> </p>

<form method="post" action="index.php?action=modifyComment&amp;id=<?= $post['id'] ?>&amp;comment_id=<?= $comment['id'] ?>">
	<p>
		<label for="comment">Nouveau commentaire</label> <br />
		<textarea id="comment" name="comment" cols="50" rows="10"></textarea> <br />
		<input type="submit" />
	</p>
</form>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>