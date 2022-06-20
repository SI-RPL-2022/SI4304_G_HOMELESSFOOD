@extends('layout/dashboard')

@section('title')
	Detail Transaksi
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<a href="/transaction" class="btn btn-outline-secondary">Kembali</a>
			</div>

			<div class="col-md-10">
				<div class="alert alert-primary">
					<div class="row">
						<div class="col-md-8">
							<h6>Konfirmasi Pengantaran</h6>
							Harap lakukan konfirmasi ketika pesanan sudah selesai diantar
						</div>
						<div class="col-md-4">
							<a href="/driver/complete_order/{{$transaction->transaction_id}}" onclick="return confirm('Apakah kamu yakin meyelesaikan pesanan ini ?')" class="btn btn-success btn-block">Pesanan Selesai Diantar</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		@if (session('alert'))
		    <div class="row mt-4">
		    	<div class="col-md-12">
			        {!! session('alert') !!}
			    </div>
		    </div>
		@endif

		<div class="card shadow mt-3 mb-3">
			<div class="card-header">
				<h6>TRANSAKSI</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<small class="text-muted">Kode</small><br>
						#{{$transaction->transaction_code}}
					</div>
					<div class="col-md-3">
						<small class="text-muted">Tanggal</small><br>
						{{$transaction->created_at}}
					</div>
					<div class="col-md-3">
						<small class="text-muted">Pemesan</small><br>
						{{$transaction->nama}}<br>
						{{$transaction->no_hp}}
					</div>

					<div class="col-md-3">
						<small class="text-muted">Status</small><br>
						@if($transaction->status == 'pending')
							<span class="badge bg-primary text-white">Upload pembayaran</span>
						@elseif($transaction->status == 'need_confirmation')
							<span class="badge bg-info text-white">Konfirmasi pembayaran</span>
						@elseif($transaction->status == 'verified')
							<span class="badge bg-success text-white">Pembayaran diterima</span><br>
							<small class="text-muted">Sedang mencari driver makanan...</small>
						@elseif($transaction->status == 'on_delivery')
							<span class="badge bg-warning">Pesanan sedang diantar</span>
						@elseif($transaction->status == 'complete')
							<span class="badge bg-success">Selesai</span>
						@elseif($transaction->status == 'deny')
							<span class="badge bg-danger text-white">Ditolak</span>
						@endif
					</div>
				</div>
			</div>
		</div>

		<div class="card shadow mt-4">
			<div class="card-header">
				<h6>DRIVER</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-1">
						<?php 
							$photo = $transaction->driver_photo == '' ? 'default.png' : $transaction->driver_photo;
						?>
						<img style="border-radius: 50%; width: 60px; height: 60px" src="/gambar/{{$photo}}">
					</div>
					<div class="col-md-2">
						<small class="text-muted">Driver</small><br>
						{{$transaction->driver_name}}
					</div>
					<div class="col-md-2">
						<small class="text-muted">No HP</small><br>
						{{$transaction->driver_phone}}
					</div>
					<div class="col-md-2">
						<small>Waktu Terima</small><br>
						{{$transaction->delivery_at}}
					</div>
					<div class="col-md-3">
						<small>Waktu Selesai Pengantaran</small><br>
						@if($transaction->complete_at !== '')
							{{$transaction->complete_at}}
						@endif
					</div>
				</div>
			</div>
		</div>

		<?php 
			$homeless = json_decode($transaction->homeless_data);
		?>
		<div class="card shadow mt-4">
			<div class="card-header">
				<h6>PENERIMA</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<small class="text-muted">Nama</small><br>
						{{$homeless->name}}
					</div>
					<div class="col-md-4">
						<small class="text-muted">Ciri - Ciri</small><br>
						{{$homeless->characteristic}}
					</div>
					<div class="col-md-3">
						<small class="text-muted">Lokasi</small><br>
						{{$homeless->location_detail}}<br>
						<small>{{$homeless->dis_name}} {{$homeless->subdis_name}}</small>
					</div>
					<div class="col-md-2">
						<button data-toggle="modal" data-target="#modalPhoto" class="btn btn-sm btn-outline-primary btn-block">
							Lihat Foto
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="card shadow mt-4">
			<div class="card-header">
				<h6>MAKANAN</h6>
			</div>
			<div class="card-body">
				<table class="table">
					<thead class="bg-secondary text-white">
						<tr>
							<th style="width:15%"></th>
							<th>Makanan</th>
							<th style="width:15%">Harga</th>
							<th class="text-center" style="width: 10%">Jumlah</th>
						</tr>
					</thead>
					<tbody>
						@foreach($item as $row)
							<tr>
								<td>
									<img class="img-fluid" src="/images/food/{{$row->food_photo}}" >
								</td>
								<td>
									{{$row->food_name}}<br>
									<small class="text-muted">{{$row->food_description}}</small>
								</td>
								<td>Rp {{$row->price}}</td>
								<td class="text-center">{{$row->qty}}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th colspan="2">TOTAL</th>
							<th id="totalPrice">Rp {{$transaction->total_price}}</th>
							<th class="text-center" id="totalQty">{{$transaction->total_food}}</th>
						</tr>
					</tfoot>
				</table>
			</div>
	</div>
	

<div id="modalPhoto" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="/images/homeless/{{$homeless->photo}}" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

@endsection