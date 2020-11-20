<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
$stmt = $pdo->prepare(
'SELECT *
FROM amazon
INNER JOIN games ON games.title = amazon.title
INNER JOIN gamespot ON gamespot.title = amazon.title 
WHERE games.id = ?'
);
    $stmt->execute([$_GET['id']]);
    $game = $stmt->fetch(PDO::FETCH_ASSOC);

	
// $_GET['id'];
// $stmt = $pdo->prepare('SELECT * FROM gamespot WHERE id = 6414475');
//     $stmt->execute([$_GET['id']]);
//     $game2 = $stmt->fetch(PDO::FETCH_ASSOC);

// $_GET['id'];
// $stmt = $pdo->prepare('SELECT * FROM amazon WHERE id = 1234');
//     $stmt->execute([$_GET['id']]);
//     $game3 = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?=template_header('Details')?>

<div class="content gamebg">
    <h2 class='text-center'><?=$game['title']?></h2>
    <h3 class ='text-center'><?=$game['releaseDate']?></h3>
    <img class="game-cover center" src="<?=$game['cover']?>" alt="cover">
    <h4 class=text-center>Description</h4>
    <p class='text-center'><?=$game['summary']?><p>
    <h4 class=text-center>Storyline</h4>
    <p class='text-center'><?=$game['story']?><p>
	<h4 class='text-center'>Game Score: <?=$game['score']?></h4>
	<a href=<?= $game['link'] ?>><img class="details-amazon-link" src="/senior-project/images/amazon_button.png" alt=""></a>
</div>

<?=template_footer()?>