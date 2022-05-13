@extends('layout/template')

@section('content')
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="card shadow">
					<div class="card-header text-center bg-warning text-white">
						<h5 class="card-title">REGISTER</h5>
					</div>

					<div class="card-body">
						@if (session('alert'))
						    <div class="row mt-4">
						    	<div class="col-md-12">
							        {!! session('alert') !!}
							    </div>
						    </div>
						@endif

						<form method="POST" action="/auth/do_register">
							@csrf
							<div class="form-group">
						    <label for="exampleInputEmail1">Nama Lengkap</label>
						    <input name="nama" required="" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nama Lengkap">
						  </div>
						  <div class="form-group">
						    <label for="exampleInputEmail1">Email Address</label>
						    <input name="email" required="" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Email">
						  </div>
						  <div class="form-group">
						    <label for="exampleInputEmail1">Nomor Handphone</label>
						    <input name="no_hp" required="" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan No. Handphone">
						  </div>
						  <div class="form-group">
						    <label for="exampleInputPassword1">Password</label>
						    <input name="password" placeholder="Masukkan Password" type="password" class="form-control required" id="exampleInputPassword1">
						  </div>

						  	<center>
							  <button type="submit" class="btn btn-secondary">DAFTAR SEKARANG</button>
							</center>
						</form>

						<hr>

						Anda sudah punya akun ?, <a href="/auth/login" class="text-warning"><b>Login Disini</b></a>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection