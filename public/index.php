<?php

    // configuration
    require("../includes/config.php"); 

    $rows = CS50::query("SELECT symbol,shares FROM portfolios WHERE user_id=?",$_SESSION["id"]);
    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" =>strtoupper($row["symbol"]),
                "total" => ($stock["price"] * $row["shares"])
            ];
        }
    }
    
    $users = CS50::query("SELECT cash FROM users WHERE id=? ",$_SESSION["id"]);
    foreach ($users as $user)
    {
        $cash = $user["cash"];
    }
    $cash = $user["cash"];
    // render portfolio
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio","total" => $cash]);
    
?>
