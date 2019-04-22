@extends( 'admin.layout.admin' )@section( 'breadcrumbs' )
<!-- breadcrumbs -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-9">
		<h2>Gerenciador de Imagens</h2>
		<ol class="breadcrumb">
			<li>
				<a href="/admin">Paínel de controle</a>
			</li>
			<li class="active">Gerenciador de Imagens </li>
		</ol>
	</div>
	<div class="col-md-3 padding-btn-header text-right">

	</div>
</div>

@endsection @section( 'content' )
<div class="row">
	<div class="col-md-9">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<div class="row">
					<div class="col-md-9" id="OLFiles-list-dir" style="padding-top:5px;">

					</div>
					<div class="col-md-3" id="OLFiles-form-folder">


					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" id="OLFiles-list-files" style="padding-top:15px;">

				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3" id="OLFiles-dropzone">

	</div>

</div>
@endsection
@section( 'modal' )
@include('admin.files.openImage');
@endsection
@push( 'style' )
<style>
	.modal-edit-image {
		position: absolute;
		float: left;
		left: 0px;
		right: 0px;
		top: 0px;
		bottom: 0px;
		background: rgba(27, 39, 53, 0.8);
		z-index: 9999;
		display: none;
		align-items: center;
	}
	.modal-edit-image.open{
		display: flex;
	}

	.image-content {
		display: block;
		width: 60%;
		height: auto;
		margin: 0 auto;
		background: #FFF;
		padding: 0;
	}

	.image-content>header,
	.image-content>footer {
		display: block;
		margin: 0px;
		padding: 10px;
		height: 50px;
		background: #F5F5F6;
	}

	.image-content>header {
		border-bottom: 1px solid #e7e7e7
	}

	.image-content>header .col-md-8 {
		padding-right: 10px;
	}

	.image-content>footer {
		border-top: 1px solid #e7e7e7
	}

	.image-content>section {
		display: block;
		margin: 0px;
		padding: 0px;
		height: 500px;
		max-height: 500px;
		overflow: hidden;
	}

	.image-content>section>.row {
		margin: 0px;
	}

	.image-content>section>.row>.col-md-8 {
		padding: 0px;
	}

	img {
		max-width: 100%;
		max-width: 100%;
	}

	.file .file-name>p {
		width: 100%;
		height: 22px;
		overflow: hidden;
	}


	#list-dir {
		padding-top: 5px;
	}

	span.w-fixed {
		min-width: 50px;
		height: 34px;
		background-color: #eee;
		border: 1px solid #e7eaec;
		font-size: 1.1rem;
		text-align: right;
		overflow: hidden;
		padding: 8px 12px 6px 12px;
	}

	input.w-fixed {
		height: 34px;

	}

	input.w-fixed.form-control[readonly] {
		border: 1px solid #e7eaec
	}

	.docs-data .input-group,
	.docs-infos .input-group {
		margin-bottom: 10px;
	}
	.docs-infos > .form-inline input{
		width: 100px;
	}

	.docs-preview {
		padding: 15px;
		margin: 10px 0px;
		background: #F5F5F6;
		text-align: left;
		overflow: hidden;
		border: 1px solid #e7eaec;
	}

	.docs-preview h3 {
		margin-top: 0px;
		margin-bottom: 15px;
		text-transform: uppercase;
		font-size: 1.1rem;
	}
</style>
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/cropper/cropper.css') }}">
@endpush

@push( 'script' )
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLFiles-Cropper.jquery.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/plugins/cropper/cropper.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/plugins/cropper/jquery-cropper.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/plugins/cropper/cropper-main.js') }}"></script>

<script>

	$("body").OLFiles({
			actionListFolders : "{{ Route('files-get-all') }}",
			actionCreateFolder : "{{ Route('create-folder') }}",
			actionOpenFile : '/nada',
			actionSendFile : "{{ Route('send-files') }}",
			initialFolder : "public/",
		});
</script>


@endpush