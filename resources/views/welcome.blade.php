@extends('layouts.default')
@section('content')

@stop
<script type="text/javascript">
    var access = null;
     access = localStorage.getItem('token');
    if (access == null) {
        var locationUrl = '{{url("/")}}';
        window.location.href = locationUrl+'/login';
    }
</script>