@extends('layout/dashboard')

@section('title')
	Tunawisma
@endsection

@section('content')
	<div class="container">
		<a href="/homeless/add" class="btn btn-primary">Tambah Tunawisma</a>

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
					<th>Detail</th>
					<th style="width: 10%" class="text-center">Total Tunawisma</th>
					<th style="width: 15%" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				@if(count($homeless) > 0)
					@foreach ($homeless as $row) 
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>
								<img src="/images/homeless/{{ $row->photo }}" class="img-fluid">
							</td>
							<td>
								<div class="row">
									<div class="col-md-12">
										<strong>{{ $row->name }}</strong><br>
									</div>

									<div class="col-md-12">
										<span class="text-muted">Ciri - Ciri</span><br>
										<small>
											{{ $row->characteristic }}
										</small>
									</div>

									<div class="col-md-12">
										<span class="text-muted">Alamat</span><br>
										<small>
											{{ $row->location_detail }}
										</small>
									</div>

									<div class="col-md-12">
										<span class="text-muted">Lokasi</span><br>
										<small>
											{{$row->dis_name}}, {{$row->subdis_name}}
										</small>
									</div>
								</div>
							</td>
							<td class="text-center">{{ $row->total_count }}</td>
							<td class="text-center">
								<!--<a href="/homeless/edit/{{ $row->id }}" class="btn btn-outline-warning btn-sm">Ubah</a>-->
								<a href="/homeless/delete/{{ $row->id }}" class="btn btn-outline-danger btn-sm">Hapus</a>
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