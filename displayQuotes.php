
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Document</title>
</head>
<body>
<div id="quote"></div>

<script>
    // Function to get quotes and display them in a list on the page
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
                document.getElementById('quote').innerHTML = html;
            })
            .catch(function (error) {
                console.log("NOPE");
            });
    }

    // Call the function on page load
    getQuote();
</script>
</div>
</body>
</html>

