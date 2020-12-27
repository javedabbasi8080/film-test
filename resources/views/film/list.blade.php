@extends('layouts.default')
@section('content')


<div class="row">
	<div id="append"></div>
    
</div>



<script type="text/javascript">

$(document).ready(function() {
    $('.js-multiple').select2();
});

loadFilms();

function loadFilms(){

	var url = "{{url('api/films')}}";
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
        	var urlWeb = "{{url('films')}}";

        	for (var i = 0; i < filmData.length; i++) {

        		 films += `<div class="col-md-4">
					  		<div class="thumbnail">
					        <a href="`+urlWeb+'/'+filmData[i].slugs+`" target="_blank">
					          <img src="`+filmData[i].image+`" alt="Lights" style="width:100%">
					          <div class="caption">
					            <p>`+filmData[i].description+`</p>
					          </div>
					        </a>
					      </div>
					    </div>`;
        	}
        	
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