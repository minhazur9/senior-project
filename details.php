<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
echo $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM games WHERE id = ?');
    echo $stmt->execute([$_GET['id']]);
    $game = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?=template_header('Read')?>

<div class="content">
    <h2 class='game-title'><?=$game['title']?></h2>
    <img class="details-cover" src="<?=$game['cover']?>" alt="cover">
</div>

<?=template_footer()?>