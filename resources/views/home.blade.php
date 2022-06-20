@extends('layout/template')

@section('content')
	<div id="myCarousel" class="carousel slide bg-warning" data-ride="carousel">
		<div class="container">
		    <div class="row pt-5 pb-5">
	          <div class="col-8 text-white">
	            <h1 class="mt-5">Melayani dengan setulus hati</h1>
	            <h6>Memberikan pelayanan ekstra dan nyaman adalah prioritas kami</h6>
	            <p class="mt-4">
	            	<a class="btn btn-lg btn-outline-warning text-white" style="border:2px solid #fff" href="/select_food" role="button">Pilih Donasi Makanan</a>

	            	<a href="/driver_hiring" class="btn btn-ghost text-white">Terjadi Menjadi Driver kami ?, Daftar Disini</a>
	            </p>
	          </div>
	          <div class="col-4">
	            <img src="/gambar/homelessfood.jpg" class="img-fluid mt-4">
	          </div>
	        </div>
	    </div>
	  </div>


	  <!-- Marketing messaging and featurettes
	  ================================================== -->
	  <!-- Wrap the rest of the page in another container to center all the content. -->

	  <div class="container marketing">

	    <!-- Three columns of text below the carousel -->
	    <div class="row text-center">
	      <div class="col-lg-3">
	        <img src="/gambar/004-finger-food.png" class="img-fluid" style="width: 100px">
	        <h4 class="mt-4">Pilih Makanan</h4>
	        <p>Pilih makanan sesuai menu yang telah disediakan</p>
	      </div><!-- /.col-lg-4 -->
	      
	      <div class="col-lg-3">
	       <img src="/gambar/002-contact-form.png" class="img-fluid"  style="width: 100px">
	        <h4 class="mt-4">Isi Form</h4>
	        <p>Isi form mengenai tunawisma yang akan diberi donasi makanan</p>
	      </div><!-- /.col-lg-4 -->

	      <div class="col-lg-3">
	        <img src="/gambar/003-receipt.png" class="img-fluid"  style="width: 100px">
	        <h4 class="mt-4">Pembayaran</h4>
	        <p>Lakukan pembayaran dan upload bukti transfer</p>
	      </div><!-- /.col-lg-4 -->

	      <div class="col-lg-3">
	        <img src="/gambar/005-delivery.png" class="img-fluid"  style="width: 100px">
	        <h4 class="mt-4">Makanan Diantarkan</h4>
	        <p>Driver kami akan segera mengantarkan makanan sesuai transaksi anda</p>
	      </div><!-- /.col-lg-4 -->
	    </div><!-- /.row -->


	    <!-- START THE FEATURETTES -->

	    <hr class="featurette-divider">

	    <div class="row featurette">
	      <div class="col-md-7"><br><br><br><br><br><br>
	        <h1 class="text-warning"><b>Selalu sedia 24 / 7</b></h1>
	        <p class="lead">Kami selalu ada untuk anda bahkan disituasi genting apapun. Kami akan berusaha dan selalu memprioritaskan pesanan anda.</p>
	      </div>
	      <div class="col-md-5">
	        <img src="/gambar/h1.png" class="img-fluid">
	      </div>
	    </div>

	    <hr class="featurette-divider">

	    <div class="row featurette">
	      <div class="col-md-7 order-md-2"><br><br><br><br><br><br>
	          <h1 class="text-warning"><b>Biaya transparan dan murah</b></h1>
	          <p class="lead">Kami menawarkan harga yang transaparan dan murah bagi anda, sehingga tidak menyulitkan anda untuk mengirimkan makanan yang baik dan berkualitas</p>
	      </div>
	      <div class="col-md-5 order-md-1">
	         <img src="/gambar/h2.png" class="img-fluid">
	      </div>
	    </div>

	    
	    <!-- /END THE FEATURETTES -->

	  </div><!-- /.container -->
@endsection