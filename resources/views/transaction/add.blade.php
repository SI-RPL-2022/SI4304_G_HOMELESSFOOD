@extends('layout/dashboard')

@section('title')
	Tambah Tunawisma
@endsection

@section('content')
<div class="container">
	<a href="/transaction" class="btn btn-outline-secondary">Kembali</a>

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

	<form class="mt-4" method="POST" action="/transaction/insert" enctype="multipart/form-data">
	  @csrf
	  <div class="row">
	  	<div class="col-md-8">
	  		<div class="row">
	  			<div class="form-group col-md-9">
				    <label>Pilih tunawisma</label>
				    <select id="homeless" required="" name="homeless_id" class="form-control">
				    	<option value="">-</option>
				    	@foreach($homeless as $row)
				    		<option value="{{$row->homeless_id}}">{{$row->name}} ({{$row->dis_name}} - {{ $row->subdis_name}})</option>
				    	@endforeach
				    </select>
				</div>
	  		</div>
	  	</div>

	  	<div class="col-md-12">
	  		<div id="helper" class="text-center"></div>

	  		<div class="card" id="homelessBody">
	  			<div class="card-header">
	  				Informasi Tunawisma
	  			</div>
	  			<div class="card-body">
	  				<div class="row">
	  					<div class="col-md-8">
	  						<div class="row">
	  							<div class="col-md-8">
	  								<small class="text-muted">Nama</small><br>
	  								<span id="name"></span>
	  							</div>
	  							<div class="col-md-4">
	  								<small class="text-muted">Jumlah Tunawisma</small><br>
	  								<span id="total_count"></span>
	  							</div>
	  						</div>

	  						<div class="row mt-2">
	  							<div class="col-md-4">
	  								<small class="text-muted">Kota</small><br>
	  								<span id="city">BANDUNG</span>
	  							</div>
	  							<div class="col-md-4">
	  								<small class="text-muted">Kecamatan</small><bR>
	  								<span id="district"></span>
	  							</div>
	  							<div class="col-md-4">
	  								<small class="text-muted">Kelurahan</small><bR>
	  								<span id="subdistrict"></span>
	  							</div>
	  						</div>

	  						<div class="row mt-2">
	  							<div class="col-md-12">
	  								<small class="text-muted">Alamat Lengkap</small><br>
	  								<span id="location_detail"></span>
	  							</div>
	  						</div>

	  						<div class="row mt-2">
	  							<div class="col-md-12">
	  								<small class="text-muted">Ciri - Ciri</small><br>
	  								<span id="characteristic"></span>
	  							</div>
	  						</div>
	  					</div>
	  					<div class="col-md-4">
	  						<img id="previewImg" class="img-fluid">
	  					</div>
	  				</div>
	  			</div>
	  		</div>	
	  	</div>

	  	<div class="col-md-12 mt-4">
	  		<div class="card" id="foodBody">
	  			<div class="card-header">
	  				Pilih Menu Makanan
	  			</div>
	  			<div class="card-body">
	  				<table class="table">
	  					<thead>
	  						<tr>
	  							<th style="width:15%"></th>
	  							<th>Makanan</th>
	  							<th style="width:15%">Harga</th>
	  							<th style="width: 10%">Jumlah</th>
	  						</tr>
	  					</thead>
	  					<tbody>
	  						<tr>
	  							<th colspan="3">
	  								<span class="badge badge-success">REKOMENDASI (Paling Laris)</span>
	  							</th>
	  						</tr>
	  						@foreach($food['recommend'] as $row)
	  							<tr>
	  								<td>
	  									<input type="hidden" name="food_price[{{$row->id}}]" value="{{$row->price}}">
	  									<img class="img-fluid" src="/images/food/{{$row->food_photo}}" >
	  								</td>
	  								<td>
	  									{{$row->food_name}}<br>
	  									<small class="text-muted">{{$row->food_description}}</small>
	  								</td>
	  								<td>
	  									@if($row->price < $row->price_actual)
											<small><s>Rp {{$row->price_actual}}</s></small><br>
											Rp {{$row->price}}

										@else
											Rp {{$row->price}}
										@endif
	  								</td>
	  								<td>
	  									<input data-price="{{$row->price}}" placeholder="0" type="number" class="form-control qty" name="qty[{{$row->id}}]">
	  								</td>
	  							</tr>
	  						@endforeach

	  						<tr>
	  							<th colspan="3">
	  								<span class="badge badge-danger">DISKON</span>
	  							</th>
	  						</tr>
	  						@foreach($food['discount'] as $row)
	  							<tr>
	  								<td>
	  									<input type="hidden" name="food_price[{{$row->id}}]" value="{{$row->price}}">
	  									<img class="img-fluid" src="/images/food/{{$row->food_photo}}" >
	  								</td>
	  								<td>
	  									{{$row->food_name}}<br>
	  									<small class="text-muted">{{$row->food_description}}</small>
	  								</td>
	  								<td>
	  									@if($row->price < $row->price_actual)
											<small><s>Rp {{$row->price_actual}}</s></small><br>
											Rp {{$row->price}}

										@else
											Rp {{$row->price}}
										@endif
	  								</td>
	  								<td>
	  									<input data-price="{{$row->price}}" placeholder="0" type="number" class="form-control qty" name="qty[{{$row->id}}]">
	  								</td>
	  							</tr>
	  						@endforeach

	  						<tr>
	  							<th colspan="3">
	  								<span class="badge badge-light">LAINNYA</span>
	  							</th>
	  						</tr>
	  						@foreach($food['common'] as $row)
	  							<tr>
	  								<td>
	  									<input type="hidden" name="food_price[{{$row->id}}]" value="{{$row->price}}">
	  									<img class="img-fluid" src="/images/food/{{$row->food_photo}}" >
	  								</td>
	  								<td>
	  									{{$row->food_name}}<br>
	  									<small class="text-muted">{{$row->food_description}}</small>
	  								</td>
	  								<td>
	  									@if($row->price < $row->price_actual)
											<small><s>Rp {{$row->price_actual}}</s></small><br>
											Rp {{$row->price}}

										@else
											Rp {{$row->price}}
										@endif
	  								</td>
	  								<td>
	  									<input data-price="{{$row->price}}" placeholder="0" type="number" class="form-control qty" name="qty[{{$row->id}}]">
	  								</td>
	  							</tr>
	  						@endforeach

	  					</tbody>
	  					<tfoot>
	  						<tr>
	  							<th colspan="2">TOTAL</th>
	  							<th id="totalPrice">Rp 0</th>
	  							<th id="totalQty">0</th>
	  						</tr>
	  					</tfoot>
	  				</table>
	  			</div>
	  		</div>
	  	</div>
	  </div>

	  <button type="submit" class="btn btn-primary btn-lg mt-4" id="btnSave">CHECKOUT</button>
	</form>
</div>

<script type="text/javascript">
	$('#homelessBody').hide();
	$('#foodBody').hide();
	$('#btnSave').hide();

	$(document).on('change', '#homeless', function(){
		var e = $(this);
		if(e.val() != ''){
			$.ajax({
				method : "GET",
				url : "/homeless/by_id",
				dataType : "json",
				data : {
					homeless_id : e.val()
				},
				beforeSend : function(){
					$('#helper').html('Sedang mengambil data...')
				},
				success : function(res){
					if(res.status){
						var v = res.data
						$('#name').text(v.name);
						$('#district').text(v.dis_name);
						$('#subdistrict').text(v.subdis_name);
						$('#total_count').text(v.total_count);
						$('#characteristic').text(v.characteristic);
						$('#location_detail').text(v.location_detail);
						$('#previewImg').attr('src', '/images/homeless/'+v.photo)
						
						$('#homelessBody').show();
						$('#foodBody').show();
						$('#btnSave').show();
					}
					$('#helper').text('')
				}
			})
		}else{
			$('#foodBody').hide();
			$('#homelessBody').hide();
			$('#btnSave').hide();
		}
	})

	$(document).on('change keyup', '.qty', function(){
		var totalQty = 0;
		var totalPrice = 0;

		$('.qty').each(function(){
			var price = parseInt($(this).attr('data-price'));
			var qty   = $(this).val() == '' ? 0 : parseInt($(this).val());
			console.log(price, qty);
			totalQty += qty
			totalPrice += qty * price
		})

		$('#totalQty').text(totalQty)
		$('#totalPrice').text('Rp '+totalPrice)
	})
</script>
@endsection