<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>AIGA Minnesota Redesign</title>

	<link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,700,400italic,700italic,600italic' rel='stylesheet' type='text/css'>
	<link rel='stylesheet' href="<?php echo get_template_directory_uri(); ?>/icomoon/style.css">
	<link rel='stylesheet' href="<?php echo get_template_directory_uri(); ?>/style.css">

	<script src='http://code.jquery.com/jquery-2.1.3.js'></script>
	<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.js'></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/shared.js"></script>

</head>
<body>

	<header class='site-header'>

		<div class="container">

		<div class="row">

			<ul class='list-unstyled list-inline hidden-xs'>
				<li>
					<a href='<?php echo home_url(); ?>/about'>ABOUT</a>
				</li>
				<li>
					<a href='<?php echo home_url(); ?>/membership'>MEMBERSHIP</a>
				</li>
				<li>
					<a href='<?php echo home_url(); ?>/sponsorship'>SPONSORSHIP</a>
				</li>
				<li>
					<a href='<?php echo home_url(); ?>/blog'>BLOG</a>
				</li>
				<li class='dropdown pull-right'>
					<a id='search-dropdown-label' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						<span class='icon-search'></span>
					</a>

					<ul class='dropdown-menu' role='menu' aria-labelledby='search-dropdown-label'>
						<li class='form-control'>
							<label>
								<form enctype='multpart/form-data' method='get'>
									<input name='s' id='s' placeholder='search AIGA Minnesota'>
									<button>
										Go
									</button>
								</form>
							</label>
						</li>
					</ul>
				</li>
			</ul>

			<ul class='list-unstyled list-inline hidden-sm hidden-md hidden-lg'>
				<li>
					<a href='<?php echo home_url(); ?>/event'>EVENTS</a>
				</li>
				<li>
					<a href='<?php echo home_url(); ?>/groups'>GROUPS</a>
				</li>
				<li class='dropdown pull-right'>
					<a id='search-dropdown-label' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						<span class='icon-search'></span>
					</a>

					<ul class='dropdown-menu' role='menu' aria-labelledby='search-dropdown-label'>
						<li class='form-control'>
							<label>
								<form enctype='multpart/form-data' method='get'>
									<input name='s' id='s' placeholder='search AIGA Minnesota'>
									<button>
										Go
									</button>
								</form>
							</label>
						</li>
					</ul>
				</li>
			</ul>

		</div>

		</div>

	</header>

	<br>

	<div class="container">

		<div class="flex main-nav">
			<img class="col-md-1 col-xs-3 logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.gif" />
			<div class="col-md-3 col-xs-9 minnesota-top">
				<h2>Minnesota</h2>
			</div>
			<div class="col-md-7 col-sm-8 hidden-xs">
				<ul class='list-unstyled list-inline pull-right'>
					<li>
						<a href='<?php echo home_url(); ?>/event'>EVENTS</a>
					</li>
					<li>
						<a href='<?php echo home_url(); ?>/groups'>GROUPS</a>
					</li>
					<li>
						<a href='<?php echo home_url(); ?>/volunteer'>VOLUNTEER</a>
					</li>
				</ul>
			</div>
		</div>

	</div>
