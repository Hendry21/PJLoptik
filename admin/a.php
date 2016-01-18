<!doctype html>
  
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Autocomplete dari database dengan jQuery dan PHP | Jin Toples Programming</title>
	<link rel="stylesheet" href="style.css" />
    <link rel="stylesheet"
    href="js/jquery-ui.css" />
    <script src="js/jquery-1.8.3.js"></script>
    <script src="js/jquery-ui.js"></script>
 
    <script>
/*autocomplete muncul setelah user mengetikan minimal2 karakter */
    $(function() {  
        $( "#anime" ).autocomplete({
         source: "data.php",  
           minLength:1, 
        });
    });
    </script>
</head>
<body>
<div class="wrap">
	<h1>Jin Toples Programming</h1>
    <h1>Autocomplete dari database dengan jQuery dan PHP</h1>
	<div class="ui-widget">
		<label for="anime">Judul Anime : </label>
		<input id="anime"  />
	</div>
	<p class='copy'>Copyright &copy <a href="http://www.jintoples.blogspot.com">Jin Toples Programming</a> 2015</p>
</div>
</body>
</html>