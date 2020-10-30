<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10;
$stmt = $pdo->prepare('SELECT * FROM games ORDER BY ID LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);

$num_games = $pdo->query('SELECT COUNT(*) FROM games')->fetchColumn();
?>

<?= template_header('Read') ?>

<div class="game read">
    <h2>All Games</h2>
    <table>
        <thead>
        </thead>
        <tbody>
            <?php foreach ($games as $game) : ?>
                <tr class="list-item">
                    <td><a href="details.php?id=<?= $game['id'] ?>"><img class= "game-cover" src="<?= $game['cover'] ?>" alt="cover"></a></td>
                    <td><a href="details.php?id=<?= $game['id'] ?>"><?= $game['title'] ?></a></td>
                    <td>
                        <div class="platform-and-rating"><?= $game['platforms'] ?></h2>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <?php if ($page > 1) : ?>
                        <a class="page-link" href="list.php?page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    <?php endif; ?>
                </li>
                <?php if ($page * $records_per_page < $num_games) : ?>
                    <li class="page-item">
                        <a class="page-link" href="list.php?page=<?= $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<?= template_footer() ?>