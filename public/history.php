<?php

    // configuration
    require("../includes/config.php"); 

    $rows = CS50::query("SELECT * FROM history WHERE id=? ",$_SESSION["id"]);
    
    $history = [];
    foreach($rows as $row)
    {
        $history[] = [
            "transaction" => $row["transaction"],
            "time"        => $row["time"],
            "symbol"      => $row["symbol"],
            "shares"      => $row["shares"],
            "price"       => $row["price"]
            ];
    }
    
    // render history
    render("history.php", ["history" => $history, "title" => "Portfolio"]);
    
?>