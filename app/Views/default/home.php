<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
	<h2>Introduction au Framework W</h2>

		<?php foreach ($articles as $count => $article): ?>
		<?php if ($count % 4 == 0): ?>
			<div class="row">
		<?php endif; ?>

		<div class="col-md-3">
			<a href="<?= $this->url('article_view', ['id' => $article['id_article'] ] ); ?>"><img src="http://placehold.it/400x300" class="img-responsive img-thumbnail"></a>
			<h3><?= $article['title'] ?></h3>
			<p>Rédigé par : <?= $article['username'] ? $article['username'] : 'Anonyme' ?></p>
			<p><?= $article['content'] ?></p>
		</div>

		<?php if ( ($count + 1) % 4 == 0 || $count == 12 -1 ) : ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>

	<ul class="pagination">
		<li><a href="<?php echo $this->url( 'home', [ 'page' => $page - 1 ] ); ?>">«</a></li>
		<?php for ($i = 1; $i <= $max_pages; $i++ ) { ?>
			<li><a href="<?php echo $this->url( 'home', [ 'page' => $i ] ); ?>"><?php echo $i ?></a></li>
		<?php } ?>
		<li><a href="<?php echo $this->url( 'home', [ 'page' => $page + 1 ] ); ?>">»</a></li>
	</ul>


<?php $this->stop('main_content') ?>

<?= $this->start('sidebar') ?>

<h4>Catégories</h4>

<ul class="list-group">
	<?php foreach ($categories as $category) : ?>
  <a href="#" class="list-group-item">
    <span class="badge"><?= $category['articles']; ?></span>
    <?= $category['name']; ?>
  </a>
	<?php endforeach; ?>
</ul>

<h4>Derniers articles</h4>
<ul class="list-group">
	<?php foreach ($last_articles as $last_article) : ?>
	<a href="<?= $this->url('article_view', ['id' => $article['id_article'] ] ); ?>" class="list-group-item">
		<?= $last_article['title'] ?>
	</a>
	<?php endforeach; ?>
</ul>

<?= $this->stop('sidebar') ?>


<!-- https://github.com/WebforceLille3/EcommercePHP/blob/master/index.php -->
