<?php
session_start();

if (!file_exists("slova.txt")){
    file_put_contents("slova.txt", "nevim");
}
else{
    $slova = explode("\n", file_get_contents("slova.txt"));
}
$vyhral = false;

if (!isset($_SESSION["hledane"])) {
    $_SESSION["hledane"] = trim($slova[array_rand($slova)]);
    $_SESSION["pokusy"] = 0;
    $_SESSION["tabulka"] = "";
}

if (isset($_POST["guess"])){
    $_SESSION["pokusy"]++;
    $guess=trim($_POST["guess"]);
    $hledane=$_SESSION["hledane"];
    $tabulka=$_SESSION["tabulka"];
    $tabulka.="<tr>";
    for ($i = 0; $i < strlen($guess); $i++) {
        if ($guess[$i]===$hledane[$i]) {
            $tabulka.="<td style='background-color:green;'>".htmlspecialchars($guess[$i])."</td>";
        } elseif (strpos($hledane, $guess[$i]) !== false) {
            $tabulka.="<td style='background-color:yellow;'>".htmlspecialchars($guess[$i])."</td>";
        } else {
            $tabulka.="<td>".htmlspecialchars($guess[$i])."</td>";
        }
    }   
    $tabulka .= "</tr>";
    $_SESSION["tabulka"] = $tabulka;
    if ($guess === $hledane){
        $vyhral = true;
        file_put_contents("zebricek.txt", $hledane . ";" . $_SESSION["pokusy"] . "\n", FILE_APPEND);
    }
}
?>

<table>
<?php 
echo $_SESSION["tabulka"];
?>
</table>

<form method="POST" >
    <input type="text" name="guess" placeholder="zacit" minlength="5" maxlength="5" required <?php if($vyhral){echo "hidden";} ?>>
    <input type="submit" value="Potvrdit" <?php if($vyhral){echo "hidden";} ?>>
<?php
    //session_destroy();
    if ($vyhral) {
        echo ("<h2>Vyhral jsi za " . $_SESSION["pokusy"] . " pokusu!</h2>");
        echo ("<p><a href='hra.php'>Hrát znovu</a> nebo se podívej na <a href='statistiky.php'>statistiky</a>.</p>");
        session_destroy();
    }
?>
</form>


