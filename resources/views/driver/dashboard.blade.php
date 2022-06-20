@extends('layout/dashboard')

@section('title')
	Dashboard
@endsection

@section('content')
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
				<h6>TASK</h6>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Transaksi</th>
							<th>Penerima</th>
							<th>Lokasi</th>
							<th>Pemesan</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($transaction as $row)
							<?php 
								$homeless = json_decode($row->homeless_data);
							?>
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									<strong># {{$row->transaction_code}}</strong><br>
									<small class="text-muted">{{$row->delivery_at}}</small>
								</td>
								<td>
									{{$homeless->name}}<br>
									<small>{{$homeless->characteristic}}</small>
								</td>
								<td>
									{{$homeless->location_detail}}<br>
									<small>{{$homeless->dis_name}} {{$homeless->subdis_name}}</small>
								</td>
								<td>
									{{$row->nama}}<br>
									<small>{{$row->no_hp}}</small>
								</td>
								<td>
									<a href="/driver/detail/{{$row->transaction_id}}" class="btn btn-outline-primary btn-sm">Lihat</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection