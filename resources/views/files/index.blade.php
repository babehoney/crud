@extends('layouts.app')
@section('content')
    <div class="row">
     <div class="panel-body">
    <div class="col-md-8 col-md-offset-2">
        <div class="col-lg-12 margin-tb">
          <div class="panel-body">
            <div class="pull-left">
                <h2>List  Files</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('upload-files.create') }}"> Upload New File</a>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th>Your File</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->details }}</td>
        <td>
        <a href='{{ asset("scorm/$product->product_image") }}'>{{ $product->product_image }}</a>
        </td>
         <td>
            <a class="btn btn-info" href="{{ route('upload-files.show',$product->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('upload-files.edit',$product->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['upload-files.destroy', $product->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $products->render() !!}
@endsection

</div>
</div>
</div>