@extends('layout/template')

@section('title')
	<h5>Edit Vaccine</h5>
@endsection

@section('content')
	<a href="/vaccine" class="btn btn-outline-secondary">Back</a>

	@if (session('alert'))
	    <div class="row mt-4">
	    	<div class="col-md-12">
		        {{ session('alert') }}
		    </div>
	    </div>
	@endif

	@if($errors->any())
		<div class="alert alert-danger mt-3">
		    {!! implode('', $errors->all('<div>:message</div>')) !!}
		</div>
	@endif

	<form class="mt-4" method="POST" action="/vaccine/update/{{ $vaccine->id }}" enctype="multipart/form-data">
	  @csrf
	  <div class="form-group">
	    <label>Vaccine Name</label>
	    <input type="text" class="form-control" name="name" required="" autocomplete="off" required="" value="{{ $vaccine->name }}">
	  </div>

	  <div class="form-group">
	    <label for="exampleInputPassword1">Price</label>
	    <div class="input-group">
	        <div class="input-group-prepend">
	          <div class="input-group-text">Rp</div>
	        </div>
	        <input type="number" class="form-control" placeholder="0" required="" autocomplete="off" name="price" value="{{ $vaccine->price }}">
	    </div>
	  </div>

	  <div class="form-group">
	    <label>Deskripsi</label>
	    <textarea class="form-control" name="description" required="" autocomplete="off" required="" placeholder="Ketik deskripsi produk disini">{{ $vaccine->description }}</textarea>
	  </div>

	  <div class="row">
		  <div class="form-group col-md-5">
		    <label for="exampleInputPassword1">Image</label><br>
		    <input type="file" class="btn btn-light" name="image">
		  </div>

		  <div class="form-group col-md-7">
		  	<img style="width: 200px" src="/images/vaccines/{{ $vaccine->image }}">
		  </div>
	  </div>

	  <div class="row">
	  	<div class="col-md-12">
	  		<button type="submit" class="btn btn-warning mt-4">Update</button>
	  	</div>
	  </div>
	  
	</form>
@endsection