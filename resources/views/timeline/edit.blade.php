@extends('layout/template')

@section('content')
	<div id="myCarousel" class="slide bg-warning" data-ride="carousel" style="height: 80px">
      <div class="container mt-3">
        <br>
        <h3 class="text-white">Ubah Postingan</h3>
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
    		<form method="POST" action="/update_timeline/{{$timeline->id}}" enctype="multipart/form-data">
    			@csrf
		    	<div class="card shadow-sm">
		    		<div class="card-body">
		    			<div class="row">
		    				<div class="col-md-4">
		    					@if($timeline->thumbnail != '')
		    						<img src="/gambar/{{$timeline->thumbnail}}" class="img-fluid">
		    					@endif

		    					<label>Thumbnail</label>
		    					<input type="file" class="btn btn-light" name="thumbnail"><br>
		    					<small class="text-muted">*Upload foto jika ingin mengubah thumbnail</small>
		    				</div>

		    				<div class="col-md-8">
		    					<label>Konten</label>
		    					<textarea class="form-control" style="height:200px" required name="content" placeholder="Ketik konten disini...">{{$timeline->content}}</textarea>

		    					<button class="btn btn-warning mt-3">Ubah</button>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    </form>
    	@endif
    	</div>
    </div>
@endsection