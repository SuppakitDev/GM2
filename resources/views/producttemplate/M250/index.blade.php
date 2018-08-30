@extends('producttemplate.m250.template.m250layout')
@section('content')
<div class="por">       
   
</div>
<script type="text/javascript">

                $.ajax(
                {
                    url: "/getDashboard",
                    type: 'GET',
                }).done( 
                    function(data) 
                    {
                        $('.por').html(data.html);     
                    }
                );

</script>
@endsection