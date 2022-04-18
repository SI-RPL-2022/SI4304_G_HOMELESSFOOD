@extends('layout/template')

@section('title')
	<h5>Vaccine</h5>
	Vaccine List
@endsection

@section('content')
	<a href="/vaccine/add" class="btn btn-secondary">Add Vaccine</a>

	@if (session('alert'))
	    <div class="row mt-4">
	    	<div class="col-md-12">
		        {!! session('alert') !!}
		    </div>
	    </div>
	@endif

	<table class="table mt-4">
		<thead class="bg-secondary text-white">
			<tr>
				<th style="width: 5%">#</th>
				<th style="width: 25%">Image</th>
				<th>Name</th>
				<th style="width: 20%" class="text-right">Price</th>
				<th style="width: 15%" class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			@if(count($vaccine) > 0)
				@foreach ($vaccine as $row) 
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>
							<img src="/images/vaccines/{{ $row->image }}" class="img-fluid">
						</td>
						<td>{{ $row->name }}</td>
						<td class="text-right">Rp {{ $row->price }}</td>
						<td class="text-center">
							<a href="/vaccine/edit/{{ $row->id }}" class="btn btn-warning btn-sm">Edit</a>
							<a href="/vaccine/delete/{{ $row->id }}" class="btn btn-danger btn-sm">Delete</a>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="5" class="text-center">
						
						<h6>Data is empty</h6>
					</td>
				</tr>
			@endif
			
		</tbody>
	</table>
@endsection