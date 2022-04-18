@extends('layout/template')

@section('title')
	<h5>Register</h5>
	Register new patient. <a href="/patient/list" class="btn btn-outline-secondary btn-xs"><b>See Patient List Here</b></a>
@endsection

@section('content')
	<div class="row">
		@if (count($vaccine) > 0)

			@foreach ($vaccine as $row)

			<div class="col-md-4">
				<div class="card">
				  <img height="300" src="/images/vaccines/{{ $row->image }}" class="card-img-top" alt="...">
				  <div class="card-body">
				    <h5 class="card-title">{{ $row->name }}</h5>
				    <p class="card-text">{{ $row->description }}</p>
				  </div>
				  <div class="card-footer">
				  	<div class="row">
				  		<div class="col-md-6">
				  			Price
				  			<h6>$ {{ $row->price }}</h6>
				  		</div>
				  		<div class="col-md-6">
				  			<a href="/patient/register/{{ $row->id }}" class="btn btn-secondary btn-block">Vaccine Now</a>
				  		</div>
				  	</div>
				  </div>
				</div>
			</div>

			@endforeach

		@else
			<div class="col-md-12 text-center">
				<img src="images/add-to-cart.png" class="img-fluid" style="width: 300px">
				<h6>Vaccine's data is not addes yet, please add one!</h6>
				<a href="/vaccine/add" class="btn btn-secondary mt-2">Add Now</a>
			</div>
		@endif
	</div>
@endsection