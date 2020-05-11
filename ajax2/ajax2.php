 <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

<style> 

table {
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid black;
  padding: 2px;
}

</style>

<html>

<body>

<h1> Escriu la consulta SQL </h1>

<form id="form">
    <label for="sql">Query: </label> 
    <input id="sql" type="text">
    <input type="submit"/>
</form>


<table id="result">
<tr><td>ResultTable</td></tr>

</table>


</body>

</html>

<script>
var list;

$(document).ready(function () {
    $('#form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url : "serveijson.php?q="+$("#sql").val(),
            type: "GET",
            data: $(this).serialize(),
            success: function (data) {
                
                if (Object.keys(data)[0] === "error") {
                    $("#result").html("Hi ha hagut un error: " + data["error"]);
                } else if (data["result"] === "No rows found"){
                    $("#result").html("<tr>");
                    data["headers"].forEach(addHeader);
                    $("#result").append("</tr><tr><td colspan=\"" + data["headers"].length + "\">No hi ha cap resultat</td></tr>");

                }
                else {
                list = data;
                $("#result").html("");
                constructTable($("#result"));
                }
                
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
                $("#result").html(errorThrown);
            }
        });
    });
});


function addHeader(item) {
    $("#result").append("<td>" + item + "</td>")
}  

function constructTable(selector) { 
              
              // Getting the all column names 
              var cols = Headers(list, selector);   
     
              // Traversing the JSON data 
              for (var i = 0; i < list.length; i++) { 
                  var row = $('<tr/>');    
                  for (var colIndex = 0; colIndex < cols.length; colIndex++) 
                  { 
                      var val = list[i][cols[colIndex]]; 
                        
                      // If there is any key, which is matching 
                      // with the column name 
                      if (val == null) val = "";   
                          row.append($('<td/>').html(val)); 
                  } 
                    
                  // Adding each row to the table 
                  $(selector).append(row); 
              } 

              
          } 
            
          function Headers(list, selector) { 
              var columns = []; 
              var header = $('<tr/>'); 
                
              for (var i = 0; i < list.length; i++) { 
                  var row = list[i]; 
                    
                  for (var k in row) { 
                      if ($.inArray(k, columns) == -1) { 
                          columns.push(k); 
                            
                          // Creating the header 
                          header.append($('<th/>').html(k)); 
                      } 
                  } 
              } 
                
              // Appending the header to the table 
              $(selector).append(header); 
                  return columns; 
          }   
   

</script>