@extends('layout/template')

@section('title')
	<h5>Patient</h5>
	Patient List
@endsection

@section('content')
	<a href="/patient" class="btn btn-outline-secondary">Back</a>

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
				<th style="width: 25%">Vaccine</th>
				<th>Name</th>
				<th>NIK</th>
				<th>Alamat</th>
				<th>No Hp</th>
				<th style="width: 15%" class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			@if(count($patient) > 0)
				@foreach ($patient as $row) 
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $row->vaccine_name }}</td>
						<td>{{ $row->name }}</td>
						<td>{{ $row->nik }}</td>
						<td>{{ $row->alamat }}</td>
						<td>{{ $row->no_hp }}</td>
						<td class="text-center">
							<a href="/patient/edit/{{ $row->id }}" class="btn btn-warning btn-sm">Edit</a>
							<a href="/patient/delete/{{ $row->id }}" class="btn btn-danger btn-sm">Delete</a>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="7" class="text-center">
						
						<h6>Data is empty</h6>
					</td>
				</tr>
			@endif
			
		</tbody>
	</table>
@endsection