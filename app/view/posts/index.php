<div class="row">
	<h1>Les derniers articles</h1>
	<div>
		<?php foreach ($data as $article) { ?>
			<div>
				<p>
					Titre = <a href="?module=post&action=view&id=<?php echo $article['post_id']; ?>"> <?php echo $article['post_title']; ?></a>
					—
					Date = <?php echo $article['post_date']; ?>
				</p>
			</div>
		<?php } ?>
	</div>
</div>
