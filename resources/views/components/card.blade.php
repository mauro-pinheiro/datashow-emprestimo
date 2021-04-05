<div class="card card-primary card-outline">
    <div class="card-header">
        @isset($title)
        <h3 class="card-title">{{$title}}</h3>
        @endisset
        <div class="card-tools">
            @if($collapsable)
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            @endif
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {{$body ?? $slot}}
    </div>
    <!-- /.card-body -->
    @isset($footer)
    <div class="card-footer">
        {{$footer}}
    </div>
    @endisset
    <!-- /.card-footer -->
</div>
<!-- /.card -->
