<?php
require("header.php");

$page = "";
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
$slozka = 'stranky';
$stranky = array();
if (is_dir($slozka)) {
    $soubory = array_diff(scandir($slozka), array(".", ".."));
    foreach ($soubory as $soubor) {
        $stranky[] = str_replace(".php", "", $soubor);
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
                <?php
                foreach ($stranky as $s) {
                    if ($page == $s) {
                        $class = "wiki-link wiki-active";
                    } else {
                        $class = "wiki-link";
                    }
                    echo '<li><a class="' . $class . '" href="wiki.php?page=' . $s . '">' . $s . '</a></li>';
                }
                ?>
            </ul>
        </div>

        <div class="wiki-content">
            <?php 
            if ($page == "") {
                echo '<div class="wiki-panel">';
                echo '<h3>Vyber stránku</h3>';
                echo '<p>Klikni na název vlevo.</p>';
                echo '</div>';
            } else {
                $soubor_k_nacteni = $slozka . '/' . $page . '.php';
                
                if (file_exists($soubor_k_nacteni)) {
                    echo '<div class="wiki-panel">';
                    include($soubor_k_nacteni);
                    echo '</div>';
                } else {
                    echo '<div class="wiki-panel">';
                    echo '<h3>Stránka nenalezena</h3>';
                    echo '<p>Taková stránka tu není.</p>';
                    echo '</div>';
                }
            } 
            ?>
        </div>
    </div>
</main>

<?php 
include('footer.php'); 
?>