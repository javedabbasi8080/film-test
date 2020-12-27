@extends('layouts.default')
@section('content')


<div class="row">
	<div id="append"></div>
    
</div>



<script type="text/javascript">



loadFilms();

function loadFilms(){

	var url = "{{url('api/films/'.$slug)}}";
     $.ajax({
        url:url,
        cache: false,
        processData: false,
        contentType: false,
        type: 'get',
        headers: {
		    "Authorization": "Bearer " + localStorage.getItem('token')
		  },
        success: function (data) {
        	$("#append").empty();
        	var filmData  = data.data;
        	var films = '';
        	var genreHtml = '';

        	var urlWeb = "{{url('films')}}";
        	var genres = filmData.genres;


        	for (var i = 0; i < genres.length; i++) {
        		genreHtml += `<br>`+genres[i].name;
        	}
  
        	films += `<div class="col-md-12">
				  		<div class="thumbnail">
				        <a href="`+urlWeb+'/'+filmData.slugs+`" target="_blank">
				          <img src="`+filmData.image+`" alt="Lights" style="width:30%">
				          <div class="caption">
				            <p><b>Description: </b>`+filmData.description+`</p>
				            <p><b>Genre: </b>`+genreHtml+`</p>
				          </div>
				        </a>
				      </div>
				    </div>`;

        	$("#append").append(films);
        },
        error: function(errorsJson, textStatus, errorThrown) { 

        	var errors = errorsJson.responseJSON.error;
        	$( ".v" ).each(function( index ) {
			  $( this ).css('border-color','red');
			});
    	} 
    });
}

</script>

@stop