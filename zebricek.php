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
$nejvice_slovo = "";
$nejvice_pocet = 0;
$slova_pocty = array();

for ($i = 0; $i < count($radky); $i++) {
    $casti = explode("|", $radky[$i]);
    $slovo = trim($casti[0]);
    $pokusy = trim($casti[1]);
    
    if ($slovo == "") continue;

    $celkem_pokusu += $pokusy;

    if ($pokusy < $nejrychlejsi_pokusy) {
        $nejrychlejsi_pokusy = $pokusy;
        $nejrychlejsi_slovo = $slovo;
    }

    if ($pokusy > $nejpomalejsi_pokusy) {
        $nejpomalejsi_pokusy = $pokusy;
        $nejpomalejsi_slovo = $slovo;
    }

    if (!isset($slova_pocty[$slovo])) {
        $slova_pocty[$slovo] = 0;
    }
    $slova_pocty[$slovo]++;

    if ($slova_pocty[$slovo] > $nejvice_pocet) {
        $nejvice_pocet = $slova_pocty[$slovo];
        $nejvice_slovo = $slovo;
    }
}

$posledni = array_slice($radky, -10);
?>

<main>
    <h1>Statistiky</h1>

    <?php if (count($radky) > 0) { ?>
        <h2>Přehled</h2>
        <ul>
            <li>Celkem pokusů: <?php echo $celkem_pokusu; ?></li>
            <li>Nejrychlejší: <?php echo htmlspecialchars($nejrychlejsi_slovo); ?> na <?php echo $nejrychlejsi_pokusy; ?> pokus</li>
            <li>Nejpomalejší: <?php echo htmlspecialchars($nejpomalejsi_slovo); ?> na <?php echo $nejpomalejsi_pokusy; ?> pokus</li>
            <li>Nejčastější: <?php echo htmlspecialchars($nejvice_slovo); ?> se objevilo <?php echo $nejvice_pocet; ?>x</li>
        </ul>

        <h2>Posledních 10 slov</h2>
        <table>
            <tbody>
                <?php for ($i = 0; $i < count($posledni); $i++) {
                    $casti = explode("|", $posledni[$i]);
                    $slovo = trim($casti[0]);
                    $pokusy = trim($casti[1]);
                    if ($slovo == "") continue;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($slovo); ?></td>
                        <td><?php echo $pokusy; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Zatím tu nejsou žádné záznamy ve statistikách.</p>
    <?php } ?>
</main>

<?php require("footer.php"); ?>
