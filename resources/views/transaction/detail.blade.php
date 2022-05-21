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
				@if(session()->get('user')->akses == 'user')
					@if($transaction->status == 'pending')
						<div class="alert alert-danger">
							<div class="row">
								<div class="col-md-9">
									<h6>Upload bukti pembayaran</h6>
									Anda belum melakukan pembayaran, silahkan upload bukti transfer
								</div>
								<div class="col-md-3">
									<button data-toggle="modal" data-target="#modalUpload" class="btn btn-danger btn-block">
										Upload Disini
									</button>
								</div>
							</div>
						</div>
					@elseif($transaction->status == 'need_confirmation')
						<div class="alert alert-primary">
							<div class="row">
								<div class="col-md-9">
									<h6>Menunggu konfirmasi admin</h6>
									Bukti transfer kamu telah kami terima, harap menunggu hingga kami selesai melakukan konfirmasi
								</div>
							</div>
						</div>
					@endif
				@endif

				@if(session()->get('user')->akses == 'admin')
					@if($transaction->status == 'need_confirmation')
						<div class="alert alert-primary">
							<div class="row">
								<div class="col-md-6">
									<h6>Konfirmasi Pembayaran</h6>
									Harap lakukan konfirmasi bukti pembayaran
								</div>
								<div class="col-md-6 text-right">
									<button class="btn btn-primary" data-target="#modalProof" data-toggle="modal">Lihat Bukti Transfer</button>&emsp;
									<a onclick="return confirm('Apakah kamu yakin MENERIMA pembayaran ini ?')" href="/transaction/validation_payment/{{$transaction->transaction_id}}/confirm" class="btn btn-success">Terima</a>
									<a  onclick="return confirm('Apakah kamu yakin MENOLAK pembayaran ini ?')" href="/transaction/validation_payment/{{$transaction->transaction_id}}/deny" class="btn btn-outline-danger">Tolak</a>
								</div>
							</div>
						</div>
					@endif
				@endif
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
						{{$transaction->email}}
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

		@if(in_array($transaction->status, ['verified', 'on_delivery', 'complete']))
			<div class="card shadow mt-4">
				<div class="card-header">
					<h6>DRIVER</h6>
				</div>
				<div class="card-body">
					@if($transaction->status == 'verified' && session()->get('user')->akses == 'admin')
						<form method="POST" action="/transaction/select_driver/{{$transaction->transaction_id}}">
							@csrf
							<div class="row">
								<div class="col-md-4">
									Driver
									<select name="user_id" class="form-control" required="">
										<option value="">Pilih Driver Pengantar Makanan</option>
										@foreach($driver as $row)
											<option value="{{$row->id}}">{{$row->nama}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-8">
									<button class="btn btn-primary mt-4">Pilih</button>
								</div>
							</div>
						</form>

					@elseif(in_array($transaction->status, ['on_delivery', 'complete']))
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
								<small>Waktu Selesai Pengantaran<br>
								@if($transaction->complete_at !== '')
									{{$transaction->complete_at}}
								@endif
							</div>
						</div>

					@endif
				</div>
			</div>
		@endif

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
	

<div id="modalUpload" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Bukti Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="alert alert-warning">
      		Silahkan lakukan pembayaran pada rekening dibawah ini<br>
      		<b>Nana a/n 4231235313 (BNI)</b> sebesar <b>Rp {{$transaction->total_price}}</b>
      	</div>
      	
      	<form method="POST" enctype="multipart/form-data" action="/transaction/upload_payment/{{$transaction->transaction_id}}">
      		@csrf
	      	<div class="row mt-3 mb-3">
	      		<div class="col-md-8">
	      			Bukti Transfer<br>
	      			<input type="file" name="payment_proof" required="" class="btn btn-light">
	      		</div>
	      		<div class="col-md-4">
	      			<br>
	      			<button class="btn btn-success btn-block mt-1">Upload</button>
	      		</div>
	      	</div>
	    </form>

      </div>
    </div>
  </div>
</div>

<div id="modalProof" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bukti Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="/images/payment/{{$transaction->payment_proof}}" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

@endsection