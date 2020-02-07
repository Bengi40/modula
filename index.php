<?php
require_once('config.php');
require_once('functions.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">

	<title>Accueil</title>
	<link rel="stylesheet" href="includes/styles/style.css">

</head>

<body>
	<div class="wrapper">
		<?php include('nav.php'); ?>

		<section id="carrousel">
			<div class="carrousel">
				<span class="prev">	< </span> 
				<img src="includes/img/sony-annonces-CES-2020.jpg" />
				<img src="includes/img/ps5-disign.jpg" />
				<img src="includes/img/gta6.jpg" />
				<span class="next"> > </span>		
			</div>
			<div class="granit-divider-sm"></div>
		</section>

		<section id="event">
			<h2>Evénement </h2>
			<div class='articles'>
				<article class="article">
					<a href="#">
						<div><img src="includes/img/sony-conf.jpg"></div>
						<div class="title-article"><h4>Sony annonce la PS5</h4></div>
					</a>
				</article>
				<article class="article">
					<a href="#">
						<div><img src="includes/img/sony2.jpg"></div>
						<div class="title-article"><h4>Le kit dév dévoilé !</h4></div>
					</a>
				</article>
				<article class="article">
					<a href="#">
						<div><img src="includes/img/gta6min.jpg"></div>
						<div class="title-article"><h4>Le 6ème volet pour la sortie de la PS5 ?</h4></div>
					</a>
				</article>
			</div>

		</section>
	</div>
</body>

<script src="includes/scripts/js/jquery.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var $carrousel = $('#carrousel');
		var $img = $('#carrousel img');
		var indexImg = $img.length - 1;
		var i = 0;
		var $currentImg = $img.eq(i);

		$img.css('display', 'none');
		$currentImg.css('display', 'block');


		$('.next').click(function() { 

			i++;

			if (i <= indexImg) {
				$img.css('display', 'none'); 
				$currentImg = $img.eq(i); 
				$currentImg.css('display', 'block');
			} else {
				i = indexImg;
			}

		});

		$('.prev').click(function() { // image précédente
			i--; 
			if (i >= 0) {
				$img.css('display', 'none');
				$currentImg = $img.eq(i);
				$currentImg.css('display', 'block');
			} else {
				i = 0;
			}
		});

		function slideImg() {
			setTimeout(function() { 

				if (i < indexImg) { 
					i++; 
				} else { 
					i = 0;
				}
				$img.css('display', 'none');

				$currentImg = $img.eq(i);
				$currentImg.css('display', 'block');

				slideImg(); 

			}, 7000);
		}
		slideImg(); 

	});
</script>

</html>