<x-slot name="header">
    <h2 class="h4 font-weight-bold">
        {{ __("$header") }}
    </h2>
</x-slot>
<x-card colapsable="true">
    <div wire:ignore>
        @isset($search)
        <div class="row">
            <div class="col d-flex justify-content-start">
                {!! $search !!}
            </div>
            <div class="col d-flex justify-content-end">
                <a href="{{Str::slug($header, '-')}}/create" class="btn btn-primary">Cadastrar</a>
            </div>
        </div>
        @endisset
        {!! $form !!}
    </div>
</x-card>

@section('js')
<script>
    $('select').select2()
    $('select').change(function(){
        @this.set(`data.${$(this).attr('name')}`, $(this).val())
    })
    $(document).ready(function(){
        $('select').trigger('change');
    })
</script>
@stop
