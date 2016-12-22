<?php

    // configuration
    require("../includes/config.php");

    //Get user's cash amount
    $user = CS50::query("SELECT cash FROM users WHERE id =?",$_SESSION["id"]);
    $cash = $user[0]["cash"];
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("buy_form.php", ["cash" => $cash,"title" => "Buy"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a Symbolof share to Buy.");
        }
        else if (empty($_POST["shares"]))
        {
            apologize("You must provide number of Shares to buy.");
        }
        else if (preg_match("/^\d+$/", $_POST["shares"]) != TRUE)
        {
            apologize("You can buy only in whole numbers.");
        }
        else
        {
            $stock = lookup($_POST["symbol"]);
            if($stock == 0)
            {
                apologize("Invalid Symbol!");
            }
            else
            {
                $cost = $stock["price"]*$_POST["shares"];
                if($cost > $cash)
                {
                    apologize("You don't have enough balance");
                }
                
                CS50::query("INSERT INTO portfolios (user_id, symbol, shares) VALUES(?, ?, ?) 
                ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)",$_SESSION["id"],strtoupper($_POST["symbol"]),$_POST["shares"]);
                
                CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?",$cost,$_SESSION["id"]);
                
                //insert into history
                CS50::query("INSERT INTO history (id,transaction,symbol,shares,price) VALUES(?,?,?,?,?)",
                $_SESSION["id"],'BUY',strtoupper($_POST["symbol"]),$_POST["shares"],$stock["price"]);
                
                redirect("/");
            }
        }
    }

?>