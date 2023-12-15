<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Document</title>
</head>
<body>       
    <div>
        <h3>Add Quote:</h3><br>
        <!-- form to add quote. Posts to our API page for processing -->
        <form action='api.php' method='post'>
            <label for='author'>Author:</label>
            <br>
            <input type='text' id='author' name='author'>
            <br>
            <label for='quote'>Enter Quote:</label>
            <br>
            <input type='textarea' id='quote' name='quote'>
            <br>
            <button type='submit' name='action' value='addquote'>Submit Quote</button>
        </form>
    </div>
    <br>
    <hr>
    <br>
    <div>
        <h3>Remove Quote:</h3><br>
        <!-- form to remove quote, Posts to our API page for processing -->
        <form action='api.php' method='post'>
            <label for='quoteID'>Which quote would you like to remove?</label>
            <br>
            <input type='text' id='quoteID' name='quoteID'>
            <br>    
            <button type='submit' name='action' value='removequote'>Remove Quote</button>
        </form>
    </div>
    <br>
    <hr>
    <h3>Current Quotes:</h3>
    <div id="quotes"></div>
    <script>
    // Function to fetch quotes and update the DOM
    function getQuote() {
        axios.get('api.php?action=showQuotes')  //sends our showQoutes action to the api page via GET request
            .then(function (response) {
                const quotes = response.data;
                console.log(quotes);
                let html = '<ul>';
                quotes.forEach(quote => {
                    html += `<li>${quote.quoteID} "${quote.body}" - ${quote.author}</li>`;
                });
                html += '</ul>';
                document.getElementById('quotes').innerHTML = html;
            })
            .catch(function (error) {
                console.log("NOPE");
            });
    }

    // Call the function on page load so we can see what quotes we may want to remove
    getQuote();
    </script>
</body>
</html>

