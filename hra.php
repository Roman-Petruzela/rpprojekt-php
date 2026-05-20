<?php
    require("header.php");
    $skryt=FALSE;
    if($_POST)
    {
        $skryt=TRUE;
    }
    
?><main>
<form method="POST" <?php if($skryt){echo 'class="skryte"';} ?>>
    <input type="submit" value="START" name="start" <?php if($skryt){echo 'hidden';}?> >
</form>
<?php
    if($skryt)
    {
        require("logika.php");
    }
    echo'</main>';
    require("footer.php");
?>
