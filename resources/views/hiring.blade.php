@extends('layout/template')

@section('content')
	<div id="myCarousel" class="carousel slide bg-warning" data-ride="carousel">
		<div class="container">
		    <div class="row pt-5 pb-5">
	          <div class="col-8 text-white">
	            <h1 class="mt-5">Driver Food</h1>
	            <h6>Ayo daftarkan dirimu menjadi driver partner kami dan dapatkan benefitnya</h6>
	            <p class="mt-4">
	            	<a class="btn btn-lg btn-outline-warning text-white" style="border:2px solid #fff" href="/driver_hiring/register" role="button">Daftar Jadi Driver Sekarang</a>
	            </p>
	          </div>
	          <div class="col-4">
	            <img src="/gambar/deliv.png" class="img-fluid mt-4">
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
	      <div class="col-lg-4">
	        <img src="/gambar/002-contact-form.png" class="img-fluid" style="width: 100px">
	        <h4 class="mt-4">Registrasi</h4>
	        <p>Isi dan lengkapi formulir pendafaran online</p>
	      </div><!-- /.col-lg-4 -->
	      
	      <div class="col-lg-4">
	       <img src="/gambar/insurance-agent.png" class="img-fluid"  style="width: 100px">
	        <h4 class="mt-4">Verifikasi</h4>
	        <p>Admin kami akan melakukan verifikasi data, dan akan dihubungi tim kami</p>
	      </div><!-- /.col-lg-4 -->

	      <div class="col-lg-4">
	        <img src="/gambar/005-delivery.png" class="img-fluid"  style="width: 100px">
	        <h4 class="mt-4">Pengambilan Atribut</h4>
	        <p>Atribut seperti jaket dan helm, dapat diambil di kantor kami</p>
	      </div><!-- /.col-lg-4 -->

	    </div><!-- /.row -->


	    <!-- START THE FEATURETTES -->


	    
	    <!-- /END THE FEATURETTES -->

	  </div><!-- /.container -->
@endsection