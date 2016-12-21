<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Quote"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a Symbol.");
        }
        else
        {
            $s = lookup($_POST["symbol"]);
            if($s == 0)
            {
                apologize("Invalid Symbol!");
            }
            else
            {
                render("quote.php", ["title" => "Quote"]);
            }
        }
    }

?>