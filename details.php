<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
$_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM games WHERE id = 1020');
    $stmt->execute([$_GET['id']]);
    $game = $stmt->fetch(PDO::FETCH_ASSOC);
	
$_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM gamespot WHERE id = 6414475');
    $stmt->execute([$_GET['id']]);
    $game2 = $stmt->fetch(PDO::FETCH_ASSOC);

$_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM amazon WHERE id = 1234');
    $stmt->execute([$_GET['id']]);
    $game3 = $stmt->fetch(PDO::FETCH_ASSOC);
	


?>

<?=template_header('Read')?>

<div class="content gamebg">
    <h2 class='text-center'><?=$game['title']?></h2>
    <h3 class ='text-center'><?=$game['releaseDate']?></h3>
    <img class="game-cover center" src="<?=$game['cover']?>" alt="cover">
    <p class='text-center'><?=$game['summary']?><p>
	<h4 class='text-center'>Game Score: <?=$game2['score']?></h4>
	<h5 class='text-center'>Amazon Link: <?=$game3['link']?></h5>
</div>

<?=template_footer()?>