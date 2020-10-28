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
    <h2><?=$game['Title']?></h2>
    <img class="details-cover" src="<?=$game['Cover']?>" alt="cover">
</div>

<?=template_footer()?>