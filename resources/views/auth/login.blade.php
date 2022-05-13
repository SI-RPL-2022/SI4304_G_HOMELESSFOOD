@extends('layout/template')

@section('content')
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="card shadow">
					<div class="card-header text-center bg-warning text-white">
						<h5 class="card-title">LOGIN</h5>
					</div>

					<div class="card-body">
						@if (session('alert'))
						    <div class="row mt-4">
						    	<div class="col-md-12">
							        {!! session('alert') !!}
							    </div>
						    </div>
						@endif

						@if($errors->any())
							<div class="alert alert-danger mt-3">
							    {!! implode('', $errors->all('<div>:message</div>')) !!}
							</div>
						@endif

						<form method="POST" action="/auth/do_login">
						  @csrf
						  <div class="form-group">
						    <label for="exampleInputEmail1">Email address</label>
						    <input name="email" required="" autocomplete="off" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Email">
						  </div>
						  <div class="form-group">
						    <label for="exampleInputPassword1">Password</label>
						    <input name="password" placeholder="Masukkan Password" type="password" class="form-control required" id="exampleInputPassword1">
						  </div>

						  	<center>
							  <button type="submit" class="btn btn-secondary">MASUK SEKARANG</button>
							</center>
						</form>

						<hr>

						Anda belum punya akun ?, <a href="/auth/register" class="text-warning"><b>Daftar Disini</b></a>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection