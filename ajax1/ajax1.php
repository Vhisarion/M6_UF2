 <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 


<html>

<body>


<h1> Selecciona una Marca i un Model </h1>

<select id="marca" onchange="loadModels();">
  <option value="seat">Seat</option>
  <option value="bmw">BMW</option>
  <option value="volkswagen">Volkswagen</option>
  <option value="audi">Audi</option>
</select>

<select id="model">
 <option value="none">No hi ha models disponibles</option>
</select>

</body>
</html>

<script>

function loadModels() {
    var xmlhttp = new XMLHttpRequest();
    $marca = $("#marca").val();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("model").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "serveiweb.php?q=" + $marca, true);
    xmlhttp.send();
}

</script>