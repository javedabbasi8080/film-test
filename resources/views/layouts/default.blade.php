<!doctype html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>
<div class="container">

    

    <div id="main" class="row">
    	<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#"></a>
		    </div>
		    <ul class="nav navbar-nav">
		     
		      <li><a href="{{route('films')}}">Films</a></li>
		      <li><a href="{{route('films.add')}}">Add Film</a></li>
		  
		    </ul>

		    <ul class="nav navbar-nav pull-right">
		     

		      <li class="pull-right"><a href="{{url('login')}}">Login</a></li>
		      <li class="pull-right"><a href="{{url('register')}}">Register</a></li>

		  
		    </ul>
		  </div>
		</nav>
        @yield('content')

    </div>


</div>
</body>
</html>