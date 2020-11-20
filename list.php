<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10;
$platform = isset($_GET['platforms']) ? $_GET['platforms'] : "";
$platformStr = isset($_GET['platforms']) ? "platforms={$platform}": "";
$genre = isset($_GET['genre']) ? $_GET['genre'] : "";
$genreStr = isset($_GET['genre']) ? "genre={$genre}" : "";
$listTitle = "";
$sort = 'games.id';
if (isset($_GET['sort'])) {
    if($_GET['sort'] == 'a-z') {
        $sort = 'games.title';
    }
    else if($_GET['sort'] == 'rating-desc') {
        $sort = 'gamespot.score DESC';
    }
    else if($_GET['sort'] == 'price-asc') {
        $sort = 'amazon.price_num';
    }
    
}
if (isset($_GET['platforms'])) {
    $stmt = $pdo->prepare("SELECT games.id,games.cover,games.title,games.platforms,amazon.price,amazon.link,gamespot.score,amazon.price_num 
    FROM amazon
    INNER JOIN games ON games.title = amazon.title
    INNER JOIN gamespot ON gamespot.title = amazon.title
    WHERE games.platforms LIKE '%{$platform}%' ORDER BY {$sort} LIMIT :current_page, :record_per_page");
    $listTitle = ucfirst($_GET['platforms']);

    $size = $pdo->query("SELECT COUNT(games.title) 
    FROM amazon 
    INNER JOIN games ON games.title = amazon.title 
    INNER JOIN gamespot ON gamespot.title 
    WHERE games.platforms LIKE '%{$platform}%'")->fetchColumn();
} else if (isset($_GET['genre'])) {
    $stmt = $pdo->prepare("SELECT games.id,games.cover,games.title,games.platforms,amazon.price,amazon.link,gamespot.score,amazon.price_num,games.genres
    FROM amazon
    INNER JOIN games ON games.title = amazon.title
    INNER JOIN gamespot ON gamespot.title = amazon.title 
    WHERE games.genres LIKE '%{$genre}%' ORDER BY {$sort} LIMIT :current_page, :record_per_page");
    $listTitle = ucfirst($_GET['genre']);

    $size = $pdo->query("SELECT COUNT(games.title) FROM amazon 
    INNER JOIN games ON games.title = amazon.title
    INNER JOIN gamespot ON gamespot.title = amazon.title
    WHERE games.genres LIKE '%{$genre}%'")->fetchColumn();
} else {
    $stmt = $pdo->prepare(
    "SELECT games.id,games.cover,games.title,games.platforms,amazon.price,amazon.link,gamespot.score,amazon.price_num 
    FROM amazon
    INNER JOIN games ON games.title = amazon.title
    INNER JOIN gamespot ON gamespot.title = amazon.title 
    ORDER BY {$sort} LIMIT :current_page, :record_per_page");
    
    $size = $pdo->query("SELECT COUNT(*) 
    FROM amazon 
    INNER JOIN games ON games.title = amazon.title 
    INNER JOIN gamespot ON gamespot.title")->fetchColumn();
}
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $num_games = $pdo->query('SELECT COUNT(*) FROM games')->fetchColumn();
?>

<?= template_header('List') ?>

<div class="game read">
    <h2>All Games</h2>
    <table>
        <thead>
        </thead>
        <tbody>
            <h2>All <?= $listTitle ?> Games</h2>
            <div class="sort-form">
                <form action="" >
                    <?php if(isset($_GET['platforms'])) :?>
                <input type="hidden" name="platforms" value="<?php echo htmlspecialchars($_GET['platforms']);?>">
                    <?php elseif(isset($_GET['genres'])) :?>
                        <input type="hidden" name="platforms" value="<?php echo htmlspecialchars($_GET['genres']);?>">
                    <?php endif ?>
                    <label for="sort">Sort By:</label>
                    <select onchange="this.form.submit()" name="sort" id="sort">
                        <option value="">-------------</option>
                        <option value="a-z">Title</option>
                        <option value="rating-desc">Top Rated</option>
                        <option value="price-asc">Price - Lowest to Highest</option>
                    </select>
                </form>
            </div>
            <?php foreach ($games as $game) : ?>
                <tr class="list-item">
                    <td><a href="details.php?id=<?= $game['id'] ?>"><img class="game-cover" src="<?= $game['cover'] ?>" alt="cover"></a></td>
                    <td><a href="details.php?id=<?= $game['id'] ?>"><?= $game['title'] ?></a></td>
                    <td>
                        <div class="list-platform"><?= $game['platforms'] ?></h2>
                        </div>
                    </td>
                    <td>
                        <?php if ($game['price'] == "") : ?>
                            <div class="list-price">N/A</div>
                            <h4 class="amazon-default">Not available on amazon</h4>
                        <?php else : ?>
                            <div class="list-price"><?= $game['price'] ?></div>
                            <a href=<?= $game['link'] ?>><img class="amazon-link" src="/senior-project/images/amazon_button.png" alt=""></a>
                        <?php endif; ?>
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
                                    <a class="page-link" href="list.php?<?=$platformStr?><?=$genreStr?>&page=<?= $page - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                <?php endif; ?>
                </li>
                <?php if ($page * $records_per_page < $size) : ?>
                    <li class="page-item">
                                    <a class="page-link" href="list.php?<?=$platformStr?><?=$genreStr?>&page=<?= $page + 1 ?>" aria-label="Next">
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