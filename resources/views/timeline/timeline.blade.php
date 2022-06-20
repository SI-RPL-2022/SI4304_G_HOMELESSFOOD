@extends('layout/template')

@section('content')
	<div id="myCarousel" class="slide bg-warning" data-ride="carousel" style="height: 80px">
      <div class="container mt-3">
        <br>
        <h3 class="text-white">Timeline</h3>
      </div>
    </div>


    <div class="container mt-4">
    	@if (session('alert'))
		    <div class="row mb-3">
		    	<div class="col-md-12">
			        {!! session('alert') !!}
			    </div>
		    </div>
		@endif

    	@if(is_admin() || is_user())
    		<form method="POST" action="/insert_timeline" enctype="multipart/form-data">
    			@csrf
		    	<div class="card shadow-sm">
		    		<div class="card-body">
		    			<div class="row">
		    				<div class="col-md-4">
		    					<label>Thumbnail</label>
		    					<input type="file" class="btn btn-light" name="thumbnail"><br>
		    					<small class="text-muted">*Upload foto jika ingin memakai thumbnail</small>
		    				</div>

		    				<div class="col-md-8">
		    					<label>Konten</label>
		    					<textarea class="form-control" style="height:200px" required name="content" placeholder="Ketik konten disini..."></textarea>

		    					<button class="btn btn-warning mt-3">Posting Sekarang</button>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    </form>
    	@endif

    	<div class="row mt-4">
    		@foreach($timeline as $row)
    			<div class="col-md-12 mb-3">
	    			<div class="card">
				        <div class="card-body">
				          <div class="float-right text-muted">
				          	{{$row->created_at}}
				          	@if(session::has('user'))
				          		@if($row->user_id == session()->get('user')->id)
				          			<br>
				          			<div class="mt-1">
					          			<a href="/edit_timeline/{{$row->id}}" class="btn btn-outline-warning btn-sm text-right">Ubah</a>
					          			<a onclick="return confirm('Apakah kamu yakin ingin menghapus postingan ini ?')" href="/delete_timeline/{{$row->id}}" class="btn btn-outline-danger btn-sm text-right">Hapus</a>
					          		</div>
				          		@endif
				          	@endif
				          	
				          </div>
				          <h5 class="card-title">
				          	<img style="border-radius: 50%; width: 50px; height: 50px" src="/gambar/{{$row->foto}}"> &nbsp; {{$row->nama}}
				          </h5>

				          @if($row->thumbnail != '')
				          	<center>
				          		<img src="/gambar/{{$row->thumbnail}}" style="width: 300px;">
				          	</center>
				          @endif

				          <p>{!! nl2br($row->content) !!}</p>
				        </div>
				    </div>
	    		</div>
    		@endforeach

    	</div>
    </div>
@endsection