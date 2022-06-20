@extends('layout/dashboard')

@section('title')
	Tambah Driver
@endsection

@section('content')
<div class="container">
	<a href="/dashboard" class="btn btn-outline-secondary">Kembali</a>

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

	<form class="mt-4" method="POST" action="/driver/insert" enctype="multipart/form-data">
	  @csrf
	  <div class="row">
	  	<div class="col-md-8">
	  		<div class="row">
	  			<div class="form-group col-md-12">
				    <label>Nama Driver</label>
				    <input type="text" class="form-control" name="nama" required="" autocomplete="off" required="">
				</div>

				<div class="form-group col-md-12">
				    <label>Email</label>
				    <input type="text" class="form-control" name="email" required="" autocomplete="off" required="">
				</div>

				<div class="form-group col-md-12">
				    <label>No Handphone</label>
				    <input type="text" class="form-control" name="no_hp" required="" autocomplete="off" required="">
				</div>

				<div class="form-group col-md-12">
				    <label>Password</label>
				    <input type="text" class="form-control" name="password" required="" autocomplete="off" required="">
				</div>
	  		</div>
	  	</div>
	  	<div class="col-md-4">
	  		<div class="row">
		  		<div class="form-group col-md-12">
		  			<label>Foto</label>
			  		<input name="foto" type="file" class="btn btn-light">
		  		</div>
			</div>
	  	</div>
	  </div>

	  <button type="submit" class="btn btn-success">Simpan</button>
	</form>
</div>
@endsection