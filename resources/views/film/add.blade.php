@extends('layouts.default')
@section('content')
<form class="form-data" method="post" action="{{url('api/film/store')}}">

  <div class="form-group">
    <label for="name">name</label>
    <input type="text" name="name" class="form-control v" id="name">
  </div>

  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" name="description" class="form-control v" id="description">
  </div>
  <div class="form-group">
    <label for="release_date">Release date:</label>
    <input type="date" name="release_date" class="form-control v" id="release_date">
  </div>

  <div class="form-group">
    <label for="rating">rating</label>
    <input type="number" name="rating" class="form-control v" id="rating" min="1" max="5">
  </div>

  <div class="form-group">
    <label for="rating">Ticket price</label>
    <input type="number" name="ticket_price" class="form-control v" id="ticket_price">
  </div>

  <div class="form-group">
    <label for="country">country</label>
    <select class="form-control v" name="country" id="country">
    	<option value="UK">UK</option>
    	<option value="USA">USA</option>
    	<option value="UAE">UAE</option>
    </select>
    <!-- <input type="text" name="country" class="form-control v" id="country"> -->
  </div>

  <div class="form-group">


    <label for="genre">Select genre</label>
    <select class="js-multiple form-control v" name="genre[]" multiple="multiple">
	  <option value="0" disabled="">select Gen</option>
	  @foreach($genres as $genre)
	  <option value="{{$genre->id}}">{{$genre->name}}</option>
	  @endforeach
	</select>
  </div>

 <div class="form-group">
    <label for="photo">photo</label>
    <input type="file" name="photo" class="form-control v" id="photo">
  </div>



  <button type="submit" class="btn btn-default">Submit</button>
</form>



<script type="text/javascript">

$(document).ready(function() {
    $('.js-multiple').select2();
});

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
        headers: {
		    "Authorization": "Bearer " + localStorage.getItem('token')
		  },
        success: function (data) {
              alert(data.data); 
              var locationUrl = '{{url("/")}}';
        	  window.location.href = locationUrl+'/films';

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

@stop