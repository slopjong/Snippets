<?php

// This script is a test for processing GET parameters when using the HTTP method PUT.

if($_SERVER['REQUEST_METHOD'] == "PUT")
	die('{ "val": "' . $_GET["key"] . '" }');

?>

<html>
<head>
  <script src="jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $.ajax({
        url: '/get_parameter_with_put_method.php?key=val',
        type: 'put',
        dataType: "json",
        success: function(data) {
	    $("#val").text(data.val);
        }
      });
    });
  </script>
</head>
<body>
  <?php include("links.php"); ?>
  <h1>Experiment: performing a PUT request while passing a GET parameter</h1>
  Value of the passed GET parameter <em>key</em>: <span id="val"></span>
</body>
</html>
