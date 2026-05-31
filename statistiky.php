<?php
require("header.php");

$obsah = "";
if (file_exists("zebricek.txt")) {
    $obsah = file_get_contents("zebricek.txt");
}

$radky = explode("\n", $obsah);

$celkem_pokusu = 0;
$nejrychlejsi_slovo = "";
$nejrychlejsi_pokusy = 999999;
$nejpomalejsi_slovo = "";
$nejpomalejsi_pokusy = 0;
$nejcastejsi = "";
$nejcastejsi_pocet = 0;
$slovacislo = array();

for ($i = 0; $i < count($radky); $i++) {
    if (trim($radky[$i]) === "") { 
        continue;
    }
    $casti = explode(";", $radky[$i]);
    $slovo = trim($casti[0]);
    $pokusy = (int) trim($casti[1]);
    $celkem_pokusu += $pokusy; 
    if (!isset($slovacislo[$slovo])) {
        $slovacislo[$slovo] = 0;
    }
    if ($pokusy < $nejrychlejsi_pokusy) {
        $nejrychlejsi_pokusy = $pokusy;
        $nejrychlejsi_slovo = $slovo;
    }
    if ($pokusy > $nejpomalejsi_pokusy) {
        $nejpomalejsi_pokusy = $pokusy;
        $nejpomalejsi_slovo = $slovo;
    }
    $slovacislo[$slovo]++;
    if ($slovacislo[$slovo] > $nejcastejsi_pocet) {
        $nejcastejsi_pocet = $slovacislo[$slovo];
        $nejcastejsi = $slovo;
    }
}
?>

<main>
    <h1>Statistiky</h1>
<?php
if ($celkem_pokusu != 0) { 
    echo "<h2>Přehled</h2>";
    echo "<ul>";
    echo "<li>Celkem pokusů: " . $celkem_pokusu . "</li>";
    echo "<li>Nejrychlejší: " . $nejrychlejsi_slovo . " na " . $nejrychlejsi_pokusy . " pokus</li>";
    echo "<li>Nejpomalejší: " . $nejpomalejsi_slovo . " na " . $nejpomalejsi_pokusy . " pokus</li>";
    echo "<li>Nejčastější: " . $nejcastejsi . " se objevilo " . $nejcastejsi_pocet . "x</li>";
    echo "</ul>";

    echo "<h2>Posledních 10 slov</h2>";
    echo "<table>";
    echo "<tbody>";

    $pocet_radku = count($radky);
    $start = $pocet_radku - 10;
    if ($start < 0) {
        $start = 0;
    }

    for ($i = $start; $i < $pocet_radku; $i++) {
        $casti = explode(";", $radky[$i]);
        if (isset($casti[0]) && isset($casti[1])) {
            $slovo = trim($casti[0]);
            $pokusy = trim($casti[1]);
            if ($slovo != "") {
                echo "<tr>";
                echo "<td>" . $slovo . "</td>";
                echo "<td>" . $pokusy . "</td>";
                echo "</tr>";
            }
        }
    }

    echo "</tbody>";
    echo "</table>";

} 
else { 
    echo "<p>Zatím tu nejsou žádné záznamy ve statistikách.</p>";
} 
?>
</main>

<?php 
require("footer.php"); 
?>