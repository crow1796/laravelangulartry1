@extends('layout.layout', ['title' => $title])
@section('content')
	
	<div class="row" data-ng-controller="fileManagerController">
		<div class="col-sm-6 col-sm-offset-3">
			<h3 class="page-header text-center">
				Files
			</h3>

			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Date Upload</th>
						<th style="width: 130px;">Action</th>
					</tr>
				</thead>

				<tbody>
					<tr data-ng-repeat="file in files">
						<td data-ng-bind="file.id"></td>
						<td data-ng-bind="file.original_filename"></td>
						<td data-ng-bind="file.date_upload | date"></td>
						<td>
							<a href="/file/@{{ file.id }}" class="btn btn-sm btn-primary">
								<span class="fa fa-eye"></span>
							</a>
							<a target="_blank" href="/file/@{{ file.id }}/download" class="btn btn-sm btn-warning">
								<span class="fa fa-download"></span>
							</a>
							<!-- <button type="button" data-toggle="modal" data-target="#delete_file" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></button> -->
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="modal fade" role="modal" id="view_file">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						View File
						<span class="close" data-dismiss="modal">&times;</span>
					</div>
					<div class="modal-body">
						<p class="file-name"><strong>@{{ files[currentFileIndex].original_filename }}</strong></p>
					</div>
				</div>
			</div>
		</div>

	</div>
@endsection