@extends('app')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ asset('/') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li class="active">job</li>
    </ol>
@stop

@section('content')
    @if(isset($job))
    <div class="alert alert-info">
        <h4>
            <a href="{{url().'/job/'.$job->number}}"><i class="glyphicon glyphicon-star-empty"></i> {{$job->title}}</a>
        </h4>
        @foreach($job->labels as $label)
            <label class="label" style="background-color: #{{$label->color}};">{{$label->name}}</label>
        @endforeach
        <p><a target="_blank" href="{{$job->html_url}}" class="label label-primary"><i class="fa fa-github"></i></a> #{{$job->number}} opened date {{(new DateTime($job->created_at))->format('d/m/Y H:s:i')}} by <i><a class="btn-link" href="{{$job->user->html_url}}">{{$job->user->login}}</a></i></p>
    </div>
    <div class="alert alert-success">
        <p><?php echo $job->body ?></p>
    </div>
    @else
    <div class="alert alert-danger">
        <h4>No job.</h4>
    </div>
    @endif
@endsection