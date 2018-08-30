@extends('producttemplate.Z50-GW.template.z50layout')
@section('content')
<div class="por">       
   
</div>
<script type="text/javascript">

                $.ajax(
                {
                    url: "/z50getDashboard",
                    type: 'GET',
                }).done( 
                    function(data) 
                    {
                        $('.por').html(data.html);     
                    }
                );

</script>
@endsection