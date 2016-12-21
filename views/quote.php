<?php
    $s = lookup($_POST["symbol"]);
?>

<div>
    A share of <?= $s["name"]." (".$s["symbol"].")" ?> costs <b><?= "\$".number_format($s["price"], 2 , "." , ",")?></b>
</div>
