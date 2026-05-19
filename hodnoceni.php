<?php
    require("header.php");

    $ulozeno = false;
    if ($_POST) {

        $jmeno = "";
        $hodnoceni = "";
        $obtiznost = "";
        $libilo = "ne";
        $komentar = "";

        if (isset($_POST["jmeno"])) {
            $jmeno = trim($_POST["jmeno"]);
        }

        if (isset($_POST["hodnoceni"])) {
            $hodnoceni = trim($_POST["hodnoceni"]);
        }

        if (isset($_POST["obtiznost"])) {
            $obtiznost = trim($_POST["obtiznost"]);
        }

        if (isset($_POST["libilo"])) {
            $libilo = "ano";
        }

        if (isset($_POST["komentar"])) {
            $komentar = trim($_POST["komentar"]);
        }

        $radek = $jmeno . "|" . $hodnoceni . "|" . $obtiznost . "|" . $libilo . "|" . $komentar . "\n";
        file_put_contents("hodnoceni.txt", $radek, FILE_APPEND);
        $ulozeno = true;
    }
?>
<main>
    <h2>Hodnoceni</h2>
    <p>Sem muzes jednoduse napsat, jak se ti hra libi. Odpoved se ulozi do souboru a pak se zobrazi na uvodni strance.</p>

    <form method="post">
        <input type="text" name="jmeno" placeholder="Jmeno" required>

        <select name="hodnoceni" required>
            <option value="">Hodnoceni</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label>
            Obtiznost:
            <label><input type="radio" name="obtiznost" value="lehka" required> Lehká</label>
            <label><input type="radio" name="obtiznost" value="stredni"> Střední</label>
            <label><input type="radio" name="obtiznost" value="tezka"> Těžká</label>
        </label>

        <label>
            <input type="checkbox" name="libilo" value="1">
            Hru doporučuji
        </label>

        <textarea name="komentar" rows="4" placeholder="Kratky komentar"></textarea>

        <input type="submit" value="Ulozit hodnoceni">
    </form>

<?php 
    if ($ulozeno){echo ("<p>Hodnoceni bylo ulozeno.</p>");}
?>
</main>
<?php
    require("footer.php");
?>