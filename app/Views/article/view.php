<?php $this->layout('layout', ['title' => 'Article']) ?>

<?php $this->start('main_content') ?>
	<h2><?= $article['title']; ?></h2>

  <p><?= $article['content']; ?></p>


<?php $this->stop('main_content') ?>
