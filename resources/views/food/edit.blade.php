@extends('layout/dashboard')

@section('title')
	Ubah Makanan
@endsection

@section('content')
<div class="container">
	<a href="/food" class="btn btn-outline-secondary">Kembali</a>

	@if (session('alert'))
	    <div class="row mt-4">
	    	<div class="col-md-12">
		        {{ session('alert') }}
		    </div>
	    </div>
	@endif

	@if($errors->any())
		<div class="alert alert-danger mt-3">
		    {!! implode('', $errors->all('<div>:message</div>')) !!}
		</div>
	@endif

	<form class="mt-4" method="POST" action="/food/update/{{$food->id}}" enctype="multipart/form-data">
	  @csrf
	  <div class="row">
	  	<div class="col-md-8">
	  		<div class="row">
	  			<div class="form-group col-md-8">
				    <label>Nama Makanan</label>
				    <input placeholder="Ex : Nasi goreng padang" type="text" class="form-control" name="food_name" required="" autocomplete="off" required="" value="{{$food->food_name}}">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-4">
				    <label>Harga Asli</label>
				    <input placeholder="0" type="number" class="form-control" name="price_actual" required="" autocomplete="off" required="" value="{{$food->price_actual}}">
				</div>

				<div class="form-group col-md-4">
				    <label>Harga Setelah Diskon</label>
				    <input placeholder="0" type="number" class="form-control" name="price" required="" autocomplete="off" 
				    value="<?= $food->price < $food->price_actual ? $food->price : '0' ?>">
				    <small class="text-muted">*Isi 0 jika tidak ada harga diskon</small>
				</div>

				<div class="form-group col-md-12">
					<label>Deskripsi</label>
					<textarea placeholder="Ketik disini" autocomplete="off" class="form-control" required="" name="food_description">{{$food->food_description}}</textarea>
				</div>
	  		</div>
	  	</div>
	  	<div class="col-md-4">
	  		<div class="row">
		  		<div class="form-group col-md-12">
		  			<img class="img-fluid" src="/images/food/{{$food->food_photo}}">

		  			<div class="mt-3">
			  			<label>Foto</label>
				  		<input name="food_photo" type="file" class="btn btn-light"><br>
						<small class="text-muted">*Upload jika ingin mengubah foto</small>	
					</div>
		  		</div>
			</div>
	  	</div>
	  </div>

	  <button type="submit" class="btn btn-warning">Ubah</button>
	</form>
</div>
@endsection