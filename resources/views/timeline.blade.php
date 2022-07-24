@extends('layouts.app')
@section('content')
  <div class="container mt-3">
    @if (isset($msg))
      <p class="alert alert-danger">{{ $msg }}</p>
    @endif
  {!! Form::open(['route' => 'timeline', 'method' => 'POST']) !!}
    <div class="row mb-4">
      <div class="col-sm-4">
        @if (isset($image_url))
          <img src={{ $image_url }} width=30% height=auto><br>
        @else
          <img src="https://thumb.ac-illust.com/e2/e2cb85acf732de018702298367234d84_t.jpeg" width=30% height=auto><br>
        @endif
        <strong>{{ $name }}</strong>
        <br><br> 
        {{ Form::text('tweet', null, ['class' => 'form-control mr-auto']) }}
        {{ Form::file('image_url', ['id'=>'image_url','class' => 'form-control mr-auto']) }}
        {{ Form::submit('ツイート', ['class' => 'btn btn-primary']) }}
    </div>
    {!! Form::close() !!}
  </div>
@endsection
