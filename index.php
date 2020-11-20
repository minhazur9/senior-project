<?php
include 'functions.php';
// Your PHP code here.

// Home Page template below.
?>
<body>
	<?=template_header('Home')?>
	<div class="homepage">
	<div class="space">
	<div class="d-flex flex-column">
	</div>
    <div>
	<p>
		<h1 class = 'text-center boxed'>
		Welcome!
</h1>
	</p>
    <p>
		<ul class = 'boxed'>
		Today we bring the ultimate video game destination page. On our page you can:
			<li>Browse through all of the top video games out today</li>
		 	<li>Read a brief description of the games </li>
			<li>Be amazed at the artwork</li>
			<li>Use our convenient link to Amazon!</li>
			<li>We have different sections for each console, so choose your favorite!</li>
		</ul>
	</p>
	<p class = 'boxed'>Our website uses resources from Amazon, Gamespot, and IGDB to bring to you up to date information.
		Please feel free to visit these website for more information.
	</p>
	</div>
	</div>
	</div>
	<?=template_footer()?>
</body>
