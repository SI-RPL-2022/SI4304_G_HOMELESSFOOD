@extends('layout/dashboard')

@section('title')
	Makanan
@endsection

@section('content')
	<div class="container">
		<a href="/food/add" class="btn btn-primary">Tambah Makanan</a>

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
					<th style="width: 25%">Foto</th>
					<th>Makanan</th>
					<th style="width: 15%" class="text-center">Harga</th>
					<th style="width: 15%" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				@if(count($food) > 0)
					@foreach ($food as $row) 
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>
								<img src="/images/food/{{ $row->food_photo }}" class="img-fluid">
							</td>
							<td>
								<strong>{{ $row->food_name }}</strong><br>
								<small class="text-muted">{{ $row->food_description }}</small>
							</td>
							<td class="text-right">Rp {{$row->price}}</td>
							<td class="text-center">
								<a href="/food/edit/{{ $row->id }}" class="btn btn-outline-warning btn-sm">Ubah</a>
								<a href="/food/delete/{{ $row->id }}" class="btn btn-outline-danger btn-sm">Hapus</a>
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
	</div>
	
@endsection