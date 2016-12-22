<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        $stocks = CS50::query("SELECT symbol,shares FROM portfolios WHERE user_id=?",$_SESSION["id"]);
        render("sell_form.php", ["stocks"=> $stocks ,"title" => "Sell"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["symbol"]))
        {
            apologize("You must select a Stock.");
        }
        else
        {
            $stock = lookup($_POST["symbol"]);
            $sell = CS50::query("SELECT shares FROM portfolios WHERE user_id =? AND symbol=?",$_SESSION["id"],$_POST["symbol"]);
            $sp = $sell[0]["shares"]*$stock["price"];
            CS50::query("DELETE FROM portfolios WHERE user_id =? AND symbol=?",$_SESSION["id"],$_POST["symbol"]);
            CS50::query("UPDATE users SET cash = cash + ? WHERE id=?",$sp,$_SESSION["id"]);
            redirect("/");
        }
    }
?>