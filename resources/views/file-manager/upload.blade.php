@extends('layout.layout', ['title' => $title])

@section('content')
	
	<div class="row" data-ng-controller="uploadController">
		<div class="col-sm-6 col-sm-offset-3">
			<h3 class="page-header text-center">Upload file</h3>
			{!! Form::open(['class' => 'form', 'id' => 'upload_form', 'data-ng-submit' => 'processUpload($event)', 'files' => true]) !!}
			
					<div class="form-group row">
						{!! Form::label('file_upload', 'File Upload: ', ['class' => 'control-label col-md-3']) !!}
						<div class="col-md-9">
							<!-- <input class="form-control" name="file_upload" type="file" id="file_upload" file-model="file_upload" accept="video/mp4,audio/mp3,application/pdf"> -->
							{!! Form::input('file', null, ['class' => 'form-control', 'file-model' => 'file_upload', 'accept' => 'video/mp4,audio/mp3,application/pdf']) !!}
						</div>
					</div>
					<div class="form-group text-center">
						{!! Form::submit('Upload File...', ['class' => 'btn btn-md btn-default']) !!}
					</div>
					@{{ formData }}
					<div class="form-group text-center" data-ng-show="fileUploading">
						Please wait...
					</div>

			{!! Form::close() !!}
		</div>
	</div>

@endsection