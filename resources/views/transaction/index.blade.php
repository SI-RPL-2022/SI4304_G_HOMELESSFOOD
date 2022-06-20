@extends('layout/dashboard')

@section('title')
	Transaksi
@endsection

@section('content')
	<div class="container">
		@if(session()->has('user'))
          @if(session()->get('user')->akses == 'user')
           	<a href="/transaction/add" class="btn btn-primary">Tambah Transaksi</a>
          @endif
        @endif

		@if (session('alert'))
		    <div class="row mt-4">
		    	<div class="col-md-12">
			        {!! session('alert') !!}
			    </div>
		    </div>
		@endif

		<table class="table shadow mt-4">
			<thead class="bg-secondary text-white">
				<tr>
					<th style="width: 5%">#</th>
					<th>Transaksi</th>
					<th style="width: 15%">Total Makanan</th>
					<th style="width: 15%" class="text-center">Total Harga</th>
					<th style="width: 10%" class="text-center">Status</th>
					<th style="width: 15%" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				@if(count($transaction) > 0)
					@foreach ($transaction as $row) 
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>
								<div class="row">
									<div class="col-md-12">
										<strong>#{{ $row->transaction_code }}</strong><br>
										<small class="text-muted">{{$row->created_at}}</small>
									</div>
								</div>
							</td>
							<td class="text-center">{{ $row->total_food }}</td>
							<td class="text-right">Rp {{ $row->total_price }}</td>
							<td class="text-center">
								@if($row->status == 'pending')
									<span class="badge bg-primary text-white">Upload pembayaran</span>
								@elseif($row->status == 'need_confirmation')
									<span class="badge bg-info text-white">Konfirmasi pembayaran</span>
								@elseif($row->status == 'verified')
									<span class="badge bg-success text-white">Pembayaran diterima</span><br>
									<small class="text-muted">Sedang mencari driver makanan...</small>
								@elseif($row->status == 'on_delivery')
									<span class="badge bg-warning">Pesanan sedang diantar</span>
								@elseif($row->status == 'complete')
									<span class="badge bg-success">Selesai</span>
								@elseif($row->status == 'deny')
									<span class="badge bg-danger text-white">Ditolak</span>
								@endif
							</td>
							<td class="text-center">
								<a href="/transaction/detail/{{ $row->transaction_id }}" class="btn btn-outline-primary btn-sm">Lihat</a>
							</td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="6" class="text-center">
							
							<h6>Data is empty</h6>
						</td>
					</tr>
				@endif
				
			</tbody>
		</table>
	</div>
	
@endsection