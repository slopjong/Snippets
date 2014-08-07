<html>
<head>
  <script src="jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $.ajax({
        url: '/test.xml',
        type: 'get',
        dataType: "xml",
        success: function(data) {

	      // retrieve the data
          var id = $("id", data).text();
	      var name = $("name", data).text();
          
	      // render the view
	      $("#id").text(id);
          $("#name").text(name);
        }
      });
    });
  </script>
</head>
<body>
  <?php include("links.php"); ?>
  <h1>Experiment: performing an ajax request to fetch XML data</h1>
  <span id="id"></span> <span id="name"></span>
</body>
</html>
