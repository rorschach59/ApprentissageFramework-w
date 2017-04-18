<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>

	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/bootstrap-tagsinput.css') ?>">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
</head>
<body>
	<div class="container">
		<header>

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<!-- $w_site_name à définir dans config.php -->
					<a class="navbar-brand" href="<?= $this->url('home') ?>"><?= $w_site_name; ?></h1></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li <?= ($w_current_route == 'home') ? 'class="active"' : ''; ?>> <a href="<?= $this->url('home'); ?>">Accueil</a></li>
						<li <?= ($w_current_route == 'contact') ? 'class="active"' : ''; ?>> <a href="<?= $this->url('contact'); ?>">Contact</a></li>
						</ul>
						<?php if ($w_user): ?>
							<!-- Si l'utilisateur est connecté -->
							<ul class="nav navbar-nav navbar-right">
								<li <?= ($w_current_route == 'article_index') ? 'class="active"' : ''; ?>> <a href="<?= $this->url('article_index'); ?>">Articles</a></li>
								<li <?= ($w_current_route == 'security_logout') ? 'class="active"' : ''; ?>> <a href="<?= $this->url('security_logout'); ?>">Déconnexion</a></li>
							</ul>
							<?php else: ?>
								<!-- Sinon -->
								<ul class="nav navbar-nav navbar-right">
									<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profil <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li <?= ($w_current_route == 'security_register') ? 'class="active"' : ''; ?>> <a href="<?= $this->url('security_register'); ?>">Inscription</a></li>
										<li role="separator" class="divider"></li>
										<li <?= ($w_current_route == 'security_login') ? 'class="active"' : ''; ?>> <a href="<?= $this->url('security_login'); ?>">Connexion</a></li>
									</ul>
								</li>
							</ul>
						<?php endif; ?>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		</header>

		<section>
			<?php if ($this->section('sidebar')): ?>
				<div class="row">
					<div class="col-md-9">
						<?= $this->section('main_content') ?>
					</div>
					<div class="col-md-3">
						<?= $this->section('sidebar') ?>
					</div>
				<?php else: ?>
					<?= $this->section('main_content') ?>
				<?php endif; ?>
			</div>
		</section>

		<footer>
			<!-- Latest compiled and minified JavaScript -->
			<script src="<?= $this->assetUrl('js/jquery-3.1.1.min.js') ?>"></script>
			<script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>
			<script src="<?= $this->assetUrl('js/bootstrap-tagsinput.min.js') ?>"></script>
			<script src="<?= $this->assetUrl('js/typeahead.bundle.js') ?>"></script>
			<script src="<?= $this->assetUrl('js/app.js') ?>"></script>
		</footer>
	</div>
</body>
</html>
