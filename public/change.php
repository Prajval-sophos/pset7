<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("change_form.php", ["title" => "ChangePassword"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["curr_password"]))
        {
            apologize("You must provide your current password.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide a new password.");
        }
        else if ($_POST["password"] != $_POST["confirmation"] )
        {
            apologize("Passwords do not match.");
        }
        else
        {
            $rows = CS50::query("SELECT * FROM users WHERE id =?",$_SESSION["id"]);
            $row = $rows[0];
            if (password_verify($_POST["curr_password"], $row["hash"]))
            {
                CS50::query("UPDATE users SET hash = ?",password_hash($_POST["password"], PASSWORD_DEFAULT));
            }
            // else apologize
            else
            {
                apologize("Invalid password.");
            }
            // log out current user, if any
            logout();

            // redirect user
            redirect("/");
        }
    }

?>