<?php session_start(); ?>
<?php require_once("backend/ClsSelect.php"); ?>
<!doctype html>
<html lang="en">

<head>


	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="images/Custom/PublicLocation.png">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Source+Serif+Pro:wght@400;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">
	<link rel="stylesheet" href="fonts/icomoon/style.css">
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
	<link rel="stylesheet" href="css/daterangepicker.css">
	<link rel="stylesheet" href="css/aos.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/CustomUser.css">

	<title>CityRoute</title>
	<style>
		* {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			scroll-behavior: smooth;
		}

		h1,
		.h1,
		h2,
		.h2,
		h3,
		.h3,
		h4,
		.h4 {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}

		.list-search {
			list-style: none;
			position: absolute;
			width: 83%;
			background-color: #ffffff;
			border-radius: 0 0 5px 5px;
			justify-content: center;
			z-index: 100;
			top: 75px;
			left: 30px;
		}

		.list-items-search {
			transform: translate(-20px, 0px);
			padding: 5px;
			overflow: scroll;
		}

		.list-items-search:hover {
			background-color: #dddddd;
			width: 100%;
		}


		/* this card is inspired form this - https://georgefrancis.dev/ */

		.card-route {
			--border-radius: 0.75rem;
			--primary-color: #1A374D;
			--secondary-color: #6998AB;
			width: 90%;
			font-family: "Arial";
			padding: 1rem;
			cursor: pointer;
			border-radius: var(--border-radius);
			background: #f1f1f3;
			box-shadow: 0px 8px 16px 0px rgb(0 0 0 / 3%);
			position: relative;
		}

		.card-route>*+* {
			margin-top: 1.1em;
		}

		.card-route .card__content-route {
			color: var(--secondary-color);
			font-size: 0.86rem;
		}

		.card-route .card__title-route {
			padding: 0;
			font-size: 1.3rem;
			font-weight: bold;
		}

		.card-route .card__date-route {
			color: #1A374D;
			font-size: 0.8rem;
		}

		.card-route .card__arrow-route {
			position: absolute;
			background: var(--primary-color);
			padding: 0.4rem;
			border-top-left-radius: var(--border-radius);
			border-bottom-right-radius: var(--border-radius);
			bottom: 0;
			right: 0;
			transition: 0.2s;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.card-route svg {
			transition: 0.2s;
		}

		/* hover */
		.card-route:hover .card__title-route {
			color: var(--secondary-color);
			text-decoration: underline;
		}

		.card-route:hover .card__arrow-route {
			background: var(--secondary-color);
		}

		.card-route:hover .card__arrow-route svg {
			transform: translateX(3px);
		}

		#routeStn {
			margin: 25px 0px;
		}

		#ChangeRoute {
			font-size: 15px;
		}
		#map{
			transform: translateY(10%);
		}
	</style>

</head>

<body>
	<div class="site-mobile-menu site-navbar-target">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close">
				<span class="icofont-close js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>


	<nav class="site-nav">
		<div class="container">
			<div class="site-navigation">
				<a href="index.html" class="logo m-0">CityRoute <span class="text-primary">.</span></a>

				<ul class="js-clone-nav d-none d-lg-inline-block text-left site-menu float-right">
					<li class=""><a href="../CityRoute">Home</a></li>
					<li class="has-children">
						<a href="#">All Bus</a>
						<ul class="dropdown">
							<?php
							$obj = new GetAll();
							$GetBus = $obj->GetBus();
							if ($GetBus->num_rows > 0) :
								foreach ($GetBus as $row) :
							?>
									<li><a href="elements.html">Bus No. <?php echo $row['BusId']; ?></a></li>
							<?php
								endforeach;
							endif;
							?>
						</ul>
					</li>
					<li><a href="about.php">About</a></li>
					<li><a href="contact.php">Contact Us</a></li>
					<li><a href="about.php">Login/Registraion</a></li>
				</ul>

				<a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
					<span></span>
				</a>

			</div>
		</div>
	</nav>