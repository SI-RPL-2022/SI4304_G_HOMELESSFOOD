@extends('layout/template')

@section('title')
	<h5>Add Vaccine</h5>
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

	<form class="mt-4" method="POST" action="/vaccine/insert" enctype="multipart/form-data">
	  @csrf
	  <div class="form-group">
	    <label>Vaccine Name</label>
	    <input type="text" class="form-control" name="name" required="" autocomplete="off" required="">
	  </div>

	  <div class="form-group">
	    <label for="exampleInputPassword1">Harga</label>
	    <div class="input-group">
	        <div class="input-group-prepend">
	          <div class="input-group-text">RP</div>
	        </div>
	        <input type="number" class="form-control" placeholder="0" required="" autocomplete="off" name="price">
	    </div>
	  </div>

	  <div class="form-group">
	    <label>Deskripsi</label>
	    <textarea class="form-control" name="description" required="" autocomplete="off" required=""></textarea>
	  </div>

	  <div class="form-group">
	    <label for="exampleInputPassword1">Image</label><br>
	    <input type="file" class="btn btn-light" required="" name="image">
	  </div>

	  <button type="submit" class="btn btn-secondary">Submit</button>
	</form>
@endsection