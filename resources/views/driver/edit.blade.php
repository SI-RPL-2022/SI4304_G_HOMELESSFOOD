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

	<form class="mt-4" method="POST" action="/driver/update/{{$driver->id}}" enctype="multipart/form-data">
	  @csrf
	  <div class="row">
	  	<div class="col-md-8">
	  		<div class="row">
	  			<div class="form-group col-md-12">
				    <label>Nama Driver</label>
				    <input type="text" class="form-control" name="nama" required="" autocomplete="off" required="" value="{{$driver->nama}}">
				</div>

				<div class="form-group col-md-12">
				    <label>Email</label>
				    <input type="text" class="form-control" name="email" required="" autocomplete="off" required="" value="{{$driver->email}}">
				</div>

				<div class="form-group col-md-12">
				    <label>No Handphone</label>
				    <input type="text" class="form-control" name="no_hp" required="" autocomplete="off" required="" value="{{$driver->no_hp}}">
				</div>

				<div class="form-group col-md-12">
				    <label>Password</label>
				    <input type="text" class="form-control" name="password" required="" autocomplete="off" required="" value="{{$driver->password}}">
				</div>
	  		</div>
	  	</div>
	  	<div class="col-md-4">
	  		<div class="row">
		  		<div class="form-group col-md-12">
		  			<?php 
						$photo = $driver->foto == '' ? 'default.png' : $driver->foto;
					?>
		  			<img style="width:100px; height:100px" class="text-center" src="/gambar/{{$photo}}">

		  			<div class="mt-3">
			  			<label>Foto</label>
				  		<input name="foto" type="file" class="btn btn-light"><br>
						<small class="text-muted">*Upload jika ingin mengubah foto</small>	
					</div>
		  		</div>
			</div>
	  	</div>
	  </div>

	  <button type="submit" class="btn btn-warning">Ubah</button>
	</form>
</div>

@endsection