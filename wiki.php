<?php
require("header.php");

$page = "";
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$slozka = 'stranky';
$stranky = array();
if (is_dir($slozka)) {
    $soubory = scandir($slozka);
    foreach ($soubory as $f) {
        if ($f == '.' || $f == '..') continue;
        $name = pathinfo($f, PATHINFO_FILENAME);
        $stranky[] = $name;
    }
}

sort($stranky);
?>

<main>
    <h2>Wiki</h2>

    <div class="wiki-layout">
        <div class="wiki-nav-wrap">
            <h3>Stránky</h3>
            <ul class="wiki-nav">
                <?php foreach ($stranky as $s) { 
                    $class = 'wiki-link';
                    if ($page == $s) { $class = 'wiki-link wiki-active'; }
                ?>
                    <li><a class="<?php echo $class; ?>" href="wiki.php?page=<?php echo urlencode($s); ?>"><?php echo htmlspecialchars($s); ?></a></li>
                <?php } ?>
            </ul>
        </div>

        <div class="wiki-content">
            <?php if ($page == '') { ?>
                <div class="wiki-panel">
                    <h3>Vyber stránku</h3>
                    <p>Klikni na název vlevo.</p>
                </div>
            <?php } else {
                $inc = $slozka . '/' . $page . '.php';
                if (file_exists($inc)) {
                    echo '<div class="wiki-panel">';
                    include($inc);
                    echo '</div>';
                } else {
                    echo '<div class="wiki-panel">';
                    echo '<h3>Stránka nenalezena</h3>';
                    echo '<p>Taková stránka tu není.</p>';
                    echo '</div>';
                }
            } ?>
        </div>
    </div>
</main>

<?php require('footer.php'); ?>
