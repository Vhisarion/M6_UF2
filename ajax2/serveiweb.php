<input type="hidden">

<?php

// get the q parameter from URL
$q = $_REQUEST["sql"];



?>

<script>

    var val = "<?php echo $q ?>";

$(document).ready(function () {
    $.ajax({
        url : "serveijson.php?q="+val,
        type: "GET",
        data: $(this).serialize(),
        success: function (data) {

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
});


</script>