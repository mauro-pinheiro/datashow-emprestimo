@extends('adminlte::page', ['header' => $header ?? 'Laravel'])


@section('js')
<script>
    $(document).ready(function(){
        $('#Permission').select2()
    })
</script>
@stop
