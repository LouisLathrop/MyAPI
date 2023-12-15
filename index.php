<?php
//Louis Lathrop
//CSC 239
//API Final 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Louis Lathrop Final</title>
    
</head>

<body>
    <h1>Welcome to the Inspirational Quote Page.</h1>
<div>
    <h3>Enter your Information Below</h3>
    <!-- form to enter email and API key for validation -->
    <form action='validate.php' method='post'>
        <label for='email'>Email:</label>
        <input type='email' name='email'>
            <br>
            <br>
        <label for='apiKey'>API Key:</label>
        <input type='text' name='apiKey'>
            <br>
            <br>            
        <button type='submit' name='action' value='viewQuotes'>View Quotes</button>
        <button type='submit' name='action' value='editQuotes'>Edit Quotes</button>
    </form>
</div>

<div>
    <h3> Don't have an API Key or have lost yours?  Click Register below to recieve your API Key.</h3>
        <br>
        <!-- link to the register page if someone doesn't have or doesnt remember their API key-->
    <a href='registration.php'><button>Register</button></a>
</body>

</html>