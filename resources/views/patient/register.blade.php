@extends('layout/template');

@section('title')
	<h5>Form Register</h5>
	Fill your personal data to get vaccine.
@endsection

@section('content')
	<div class="row mb-4">
		<div class="col-md-12">
			<a href="/patient" class="btn btn-outline-secondary">Back</a>
		</div>
	</div>

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

	<div class="row">
		<div class="col-md-4">
			<center>
				<img src="/images/vaccines/{{ $vaccine->image }}" class="img-fluid">
			</center>
		</div>

		<div class="col-md-8">
			<h5>{{ $vaccine->name }}</h5>
			<hr>
			<p>
				{{ $vaccine->description }}
			</p>

			<div class="row">
				<div class="col-md-3">
					Price
					<h5>$ {{ $vaccine->price }}</h5>
				</div>
			</div>
			
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-md-12">
			<div class="card shadow">
				<div class="card-header"><h6>PATIENT INFORMATION</h6></div>
				<div class="card-body">
					<form method="POST" action="/patient/insert" enctype="multipart/form-data">
					  <input type="hidden" name="vaccine_id" value="{{ $vaccine->id }}">
					  @csrf
					  <div class="form-group">
					    <label>Patient Name</label>
					    <input type="text" class="form-control" name="name" required="" autocomplete="off" required="" placeholder="">
					  </div>

					  <div class="form-group">
					    <label>NIK</label>
					    <input type="text" class="form-control" name="nik" required="" autocomplete="off" required="" placeholder="">
					  </div>

					  <div class="form-group">
					    <label>Address</label>
					    <input type="text" class="form-control" name="alamat" required="" autocomplete="off" required="" placeholder="">
					  </div>

					  <div class="form-group">
					    <label>KTP</label><br>
					    <input type="file" name="image_ktp" required="">
					  </div>

					  <div class="form-group">
					    <label>No Hp</label>
					    <input type="text" class="form-control" name="no_hp" required="" autocomplete="off" required="" placeholder="">
					  </div>

					  <div class="form-group">
					  	<button class="btn btn-secondary">REGISTER</button>
					  </div>

					</form>
				</div>
			</div>
		</div>
	</div>
@endsection