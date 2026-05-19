<?php
    require("header.php");
    $hodnoceni = array();
    if (file_exists("hodnoceni.txt")) {
        $soubor = file_get_contents("hodnoceni.txt");
        $radky = explode("\n", $soubor);
        for ($r = 0; $r < count($radky); $r++) {
            $hodnoceni[] = explode("|", $radky[$r]);
        }
    }
?>
<main>
    <h2>O hře: Něco jako Wordle</h2>
    <p>Vítejte u jednoduché slovní hádanky! Vaším úkolem je odhalit skryté slovo na co nejméně pokusů.</p>
    <h2>Jak hrát?</h2>
    <ul>
        <li>Máte neomezeně pokusů (ale čím méně, tím lépe!).</li>
        <li>Po každém tipu vám barvy napoví:
            <ul>
                <li><strong>Zelená:</strong> Písmeno je na správném místě.</li>
                <li><strong>Žlutá:</strong> Písmeno ve slově je, ale jinde.</li>
                <li><strong>Šedá:</strong> Písmeno ve slově vůbec není.</li>
            </ul>
        </li>
    </ul>
    <p>Tento projekt vznikl jako ukázka jednoduchého propojení PHP a textových databází.</p>
    <h2>Hodnocení</h2>
<?php
    if (!empty($hodnoceni)) {
        for ($i = 0; $i < count($hodnoceni); $i++) {
            $z = $hodnoceni[$i];
            $jmeno = htmlspecialchars($z[0]);
            $hodn = htmlspecialchars($z[1]);
            $obtiz = htmlspecialchars($z[2]);
            $libilo = htmlspecialchars($z[3]);
            $kom = htmlspecialchars($z[4]);

            echo '<div class="hodnoceni-item">';
            echo '<p><strong>' . $jmeno . '</strong> — hodnocení: ' . $hodn . '/5</p>';
            echo '<p>Obtížnost: ' . $obtiz . ' · Líbilo se: ' . $libilo . '</p>';
            echo '<p>' . $kom . '</p>';
            echo '</div></main>';
        }
    } else {
        echo '<p>Zatim tu neni zadne hodnoceni.</p></main>';
    }
    require("footer.php");
?>