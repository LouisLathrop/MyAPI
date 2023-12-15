<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php
include "database.php";

//checks we were sent valid POST data for registration
if($_POST)
{
    
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS); //gets our email field from the POST request
    
    //Querying our DB to see if this email has been registered yet
    $userSql = " select * from Users where email = :email";
    $stmt = $db->prepare($userSql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $result = $stmt->fetchAll();

    //var_dump($result);

    //will be true if a match is found in our DB and displays the API key registered to that email
    if($result)
    {
        echo("You have already registered. Your API Key is:  ");
        echo($result[0]['apikey']);
        echo("<br><a href='index.php'><button>Home</button></a>"); //links back to home page to enter api info

        
    }

    //if email is not found
    else
    {
    $apiKey = bin2hex(random_bytes(16)); //generate a random number for API key

    //updates our users table with the email and API key using the POST email address
    $addUserSQL = "insert into Users (email, apikey) values (:email, :apiKey)"; 

    $stmt = $db->prepare($addUserSQL);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':apiKey', $apiKey);
    $stmt->execute();
    echo("Your API Key is:  ");
    echo($apiKey);
    echo("<a href='index.php'><button>Home</button></a>"); //links back to home page to enter the info
    }
}

//if no post data for some reason, displays form to register
else{
    echo("<form action='' method='post'>
    <label for='email'>Please enter your email:</label>
    <input type='email' name='email'>
    <br>
    <br>
    <button type='submit' name='register' value='register'>Register</button>
</form>");
}

?>
</body>
</html>

