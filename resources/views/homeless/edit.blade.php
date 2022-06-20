@extends('layout/dashboard')

@section('title')
	Tambah Tunawisma
@endsection

@section('content')
<div class="container">
	<a href="/homeless" class="btn btn-outline-secondary">Kembali</a>

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

	<form class="mt-4" method="POST" action="/homeless/update/{{$homeless->homeless_id}}" enctype="multipart/form-data">
	  @csrf
	  <div class="row">
	  	<div class="col-md-8">
	  		<div class="row">
	  			<div class="form-group col-md-12">
				    <label>Nama Tunawisma</label>
				    <input value="{{$homeless->name}}" type="text" class="form-control" name="name" required="" autocomplete="off" required="">
				    <small class="text-muted">*Dapat disebutkan nama perorangan ataupun kelompok</small>
				</div>

				<div class="form-group col-md-4">
					<label>Kota</label>
					<select class="form-control" required="" id="cities">
						<option value="">Pilih</option>
						<option selected="" value="161">Bandung</option>
					</select>
					<small id="helper_cities"></small>
				</div>
				<div class="form-group col-md-4">
					<label>Kecamatan</label>
					<select class="form-control region" id="dis" required="">
						@foreach($dis as $row)<option 
								<?= $homeless->dis_id == $disId ? "selected='selected'" : '' ?> 
								value="{{$row->dis_id}}">
									{{$row->dis_name}}
							</option>
						@endforeach
					</select>
					<small id="helper_dis"></small>
				</div>
				<div class="form-group col-md-4">
					<label>Kelurahan</label>
					<select class="form-control region" id="subdis" required="" name="subdis_id">
						@foreach($subdis as $row)
							<option 
								<?= $homeless->subdis_id == $row->subdis_id ? "selected='selected'" : '' ?> 
								value="{{$row->subdis_id}}">
									{{$row->subdis_name}}
							</option>
						@endforeach
					</select>
					<small id="helper_subdis"></small>
				</div>

				<div class="form-group col-md-12">
					<label>Alamat Lengkap</label>
					<textarea autocomplete="off" class="form-control" required="" name="location_detail">{{$homeless->location_detail}}</textarea>
				</div>

				<div class="form-group col-md-12">
					<label>Ciri - Ciri</label>
					<textarea autocomplete="off" class="form-control" required="" name="characteristic">{{$homeless->characteristic}}</textarea>
				</div>
	  		</div>
	  	</div>
	  	<div class="col-md-4">
	  		<div class="row">
		  		<div class="form-group col-md-12">
		  			<img src="/images/homeless/{{$homeless->photo}}" class="img-fluid">

		  			<div class="mt-2">
			  			<label>Foto</label>
				  		<input name="photo" type="file" class="btn btn-light"><br>
						<small class="text-muted">*Upload foto jika ingin mengubah</small>	
					</div>
		  		</div>
		  		
		  		<div class="form-group col-md-12" style="margin-top:-6px">
		  			<label>Jumlah Tunawisma</label>
			  		<input value="{{$homeless->total_count}}" required autocomplete="off" name="total_count" type="number" class="form-control">
		  		</div>
			</div>
	  	</div>
	  </div>

	  <button type="submit" class="btn btn-warning">Ubah</button>
	</form>
</div>

<script type="text/javascript">
	$(document).on('change', '#cities', function(){
		console.log('asd');
		var e = $(this)
		var template = "<option value=''>Silahkan pilih kota</option>";

		if(e.val() != ""){
			$.ajax({
				method : "GET",
				url : "/region/dis",
				data : {
					cities_id : e.val()
				},
				beforeSend : function(){
					$('#helper_cities').html('Sedang mengambil data...')
				},
				success : function(res){
					if(res.status){
						var txt = "";
						$.each(res.data, function(index, val){
							txt += "<option value='"+val.dis_id+"'>"+val.dis_name+"</option>";
						})
						$('#dis').html(txt).removeAttr('disabled');
					}
					$('#helper_cities').text('');
				}
			})
		}else{
			$('.region').html(template).attr('disabled', 'disabled');
		}
	})

	$(document).on('change', '#dis', function(){
		var e = $(this)
		var template = "<option value=''>Silahkan pilih kecamatan</option>";

		if(e.val() != ""){
			$.ajax({
				method : "GET",
				url : "/region/subdis",
				data : {
					dis_id : e.val()
				},
				beforeSend : function(){
					$('#helper_dis').html('Sedang mengambil data...')
				},
				success : function(res){
					if(res.status){
						var txt = "";
						$.each(res.data, function(index, val){
							txt += "<option value='"+val.subdis_id+"'>"+val.subdis_name+"</option>";
						})
						$('#subdis').html(txt).removeAttr('disabled');
					}
					$('#helper_dis').text('');
				}
			})
		}else{
			$('#subdis').html(template).attr('disabled', 'disabled')
		}
	})
</script>
@endsection