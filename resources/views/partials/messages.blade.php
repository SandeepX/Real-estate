@if(count($errors)>0)

 {{--   <div class="alert alert-danger" role="alert">
        <strong>Errors:</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>--}}

    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
        <strong>Errors:</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

@endif

@if(session('success'))

    <div class="alert alert-success" >
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{--@if(session('danger'))

    <div class="alert alert-danger">
        {{session('danger')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<!-- @if($errors->has('title'))
    <div class="invalid-feedback">
{{ $errors->first('title') }}
            </div>
@endif -->--}}


@if(session('danger'))
<div class="alert alert-danger alert-secondary alert-dismissible fade show" role="alert">
    {{session('danger')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>

@endif