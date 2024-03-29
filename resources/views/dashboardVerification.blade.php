@extends('layout/dashboard')

@section('title')
	Dashboard
@endsection

@section('content')
	@if(session()->get('user')->akses == 'admin')
		<div class="container">
			@if (session('alert'))
			    <div class="row mb-4">
			    	<div class="col-md-12">
				        {!! session('alert') !!}
				    </div>
			    </div>
			@endif
			
			<div class="card shadow">
				<div class="card-header">
					<h6>Daftar Verifikasi Driver</h6>
				</div>
				<div class="card-body">
					<a class="btn btn-light mb-3" href="/dashboard">Kembali</a> &emsp;
					<table class="table">
						<thead class="bg-secondary text-white">
							<tr>
								<th style="width: 5%">#</th>
								<th style="width: 10%">Foto</th>
								<th>Nama</th>
								<th>Kontak</th>
								<th style="width: 15%" class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							@if(count($driver) > 0)
								@foreach ($driver as $row) 
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>
											<?php 
												$photo = $row->foto == '' ? 'default.png' : $row->foto;
											?>
											<img style="border-radius: 50%; width: 60px; height: 60px" src="/gambar/{{$photo}}">
										</td>
										<td>{{$row->nama}}</td>
										<td>
											<span class="text-muted">{{$row->no_hp}}</span><br>
											<small class="text-muted">
												{{ $row->email }}
											</small>
										</td>
										<td class="text-center">
											@if($row->is_reject == '1')
												<span class="badge badge-danger">Ditolak</span>
											@else
												<a href="/driver_verification/accept/{{ $row->id }}" class="btn btn-success btn-sm">Terima</a>
												<a href="/driver_verification/deny/{{ $row->id }}" class="btn btn-outline-danger btn-sm">Tolak</a>
											@endif
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
			</div>
		</div>
	@endif
@endsection