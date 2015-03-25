@extends('app')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active"><a href="{{ asset('/') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
    </ol>
@stop

@section('content')
    <form  method="POST" action="" class="form-horizontal" name="postLinkIssuer">
        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <label>Choose Link Issuer GitHub</label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-control col-md-12" id="linkIssuer" name="linkIssuer">
                            <option value="https://api.github.com/repos/ruby-vietnam/job_board/issues">Juby-vietnam job</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-danger col-md-12">Get issuer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            <div class="row">
                @if(isset($issuers))
                @foreach($issuers as $value)
                    @if($value->state == "open")
                        <div class="alert alert-info">
                            <h4>
                                <a href="{{url().'/job?j='.$value->url}}"><i class="glyphicon glyphicon-star-empty"></i> {{$value->title}}</a>
                            </h4>
                            @foreach($value->labels as $label)
                            <label class="label" style="background-color: #{{$label->color}};">{{$label->name}}</label>
                            @endforeach
                            <p><a target="_blank" href="{{$value->html_url}}" class="label label-primary"><i class="fa fa-github"></i></a> #{{$value->number}} opened date {{(new DateTime($value->created_at))->format('d/m/Y H:s:i')}} by <i><a class="btn-link" href="{{$value->user->html_url}}">{{$value->user->login}}</a></i></p>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <h4>
                                <a href="{{url().'/job?j='.$value->url}}"><i class="glyphicon glyphicon-star-empty"></i> {{$value->title}}</a>
                            </h4>
                            @foreach($value->labels as $label)
                                <label class="label" style="background-color: #{{$label->color}};">{{$label->name}}</label>
                            @endforeach
                            <p><a target="_blank" href="{{$value->html_url}}" class="label label-primary"><i class="fa fa-github"></i></a> #{{$value->number}} opened date {{(new DateTime($value->created_at))->format('d/m/Y H:s:i')}} by <i><a class="btn-link" href="{{$value->user->html_url}}">{{$value->user->login}}</a></i></p>
                        </div>
                    @endif

                @endforeach
                @endif
            </div>
        </div>
    </form>
@endsection