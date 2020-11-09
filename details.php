<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
$_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM games WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $game = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?=template_header('Read')?>

<div class="content gamebg">
    <h2 class='text-center'><?=$game['title']?></h2>
    <h3 class ='text-center'><?=$game['releaseDate']?></h3>
    <img class="game-cover center" src="<?=$game['cover']?>" alt="cover">
    <p class='text-center'><?=$game['summary']?><p>
</div>

<?=template_footer()?>