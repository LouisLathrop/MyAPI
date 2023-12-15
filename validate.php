<?php
//this page validates user email and API key



include "database.php"; //include our datbase connection



global $db; //use our global DB PDO object

$userSql = "select * from Users";


//once we have recieved both the email and API key from the home page
if(isset($_POST['email']) && isset($_POST['apikey']));
{
    //get post info and store it
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $apiKey = filter_input(INPUT_POST, 'apiKey', FILTER_SANITIZE_SPECIAL_CHARS);
    //echo($apiKey);

    //append our sql statement to validate our email address
    $userSql .= " where email = :email";
    $stmt = $db->prepare($userSql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $result = $stmt->fetchAll();

    //var_dump($result);
    
    //if email matches we then check if api key matches
    if($result)
    {
        
        //if api key matches we are validated and can move on to the appropriate page
        if($result[0]['apikey'] === $apiKey)
        {
            //checks POST action and redirects to appropriate page
            if($_POST['action'] == 'viewQuotes')
            {
                header("Location:displayQuotes.php");
            }
            if($_POST['action'] == 'editQuotes')
            {
                header("Location:editQuotes.php");
            }
            
        }
        //if API key doesn't match, send them back to registration page
        else
        {

            header("Location:registration.php");
        }
        
    }
    //if no email match, send them back to registration page
    else
    {
        header("Location:registration.php");       
    }    
}

?>