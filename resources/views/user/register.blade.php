<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	 <div class="container">
		<form class="form-data" method="post" action="api/register">

		  <div class="form-group">
		    <label for="name">name</label>
		    <input type="text" name="name" class="form-control v" id="name">
		  </div>

		  <div class="form-group">
		    <label for="email">Email address:</label>
		    <input type="email" name="email" class="form-control v" id="email">
		  </div>
		  <div class="form-group">
		    <label for="pwd">Password:</label>
		    <input type="password" name="password" class="form-control v" id="pwd">
		  </div>

		  <div class="form-group">
		    <label for="confirm_pass">Confirm Password:</label>
		    <input type="password" name="confirm_pass" class="form-control v" id="confirm_pass">
		  </div>
		  
		  <button type="submit" class="btn btn-default">Submit</button>
		</form>
	</div>
</body>

<script type="text/javascript">

$(".form-data").submit(function(e) {

    e.preventDefault(); 
    var url = $(this).attr('action');
    var formData = new FormData($(this)[0]);


     $.ajax({
        url:url,
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
              alert(data.message); 

        },
        error: function(errorsJson, textStatus, errorThrown) { 

        	var errors = errorsJson.responseJSON.error;
        	$( ".v" ).each(function( index ) {
			  $( this ).css('border-color','red');
			});
    	} 
    });
    
});

</script>
</html>
