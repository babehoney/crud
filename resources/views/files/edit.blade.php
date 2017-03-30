@extends('layouts.app')
 
@section('content')
 <div class="row">
     <div class="panel-body">
    <div class="col-md-8 col-md-offset-2">
        <div class="col-lg-12 margin-tb">
          <div class="panel-body">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('upload-files.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($product, ['method' => 'PATCH','route' => ['upload-files.update', $product->id]]) !!}
        @include('files.form')
    {!! Form::close() !!}
@endsection


</div>
</div>
</div>