<?php
//this page allows management of API data


include "database.php"; //include our datbase connection

header('Content-Type: application/json');

global $db; //use our global DB PDO object

//checks if we have an action set in our POST data
if(isset($_POST['action']))
{
    //if the action is to add a quote, we take the post data author and quote and process our DB action
    if($_POST['action'] == 'addquote')
    {
        
        $sql = "insert into Quotes (author, body) values (:author, :quote)"; //our base sql statement

        $stmt = $db->prepare($sql); //prepares sql for modification and execution
        $stmt->bindValue(':author', $_POST['author']); //binds our author data from our POST to the sql statement
        $stmt->bindValue(':quote', $_POST['quote']); //binds our quote data from our POST to the sql statement
        $stmt->execute(); //executes our insert statement
        header('Location:editQuotes.php'); //redirects to the edit page
    }

    //if the action is to remove a quote
    if($_POST['action'] == 'removequote')
    {
        $sql = "delete from Quotes where quoteID = :id"; //our base sql statement
        $stmt = $db->prepare($sql); //prepares sql for modification and execution
        $stmt->bindValue(':id', $_POST['quoteID']); //binds our quote ID data from our POST to the sql statement
        $stmt->execute(); //executes our delete statement
        header('Location:editQuotes.php'); //redirects to the edit page
      
    }
 
}

//if we have GET action to show quotes instead of POST data to add/remove quotes
elseif($_GET['action'] == 'showQuotes')
    {
        $sql = "select * from Quotes"; //sql statement to retrieve quotes

        $qry = $db->query($sql)->fetchAll(); //submits query and stores results
        
        
        echo json_encode($qry); //prints our results in json format
    }

?>