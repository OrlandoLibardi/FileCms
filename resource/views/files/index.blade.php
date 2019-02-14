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
			<div class="row" >
				<div class="col-md-12" id="OLFiles-list-files" style="padding-top:15px;">

				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3" id="OLFiles-dropzone">

	</div>
</div>

@endsection @push( 'style' )
<style>
.file .file-name > p {
	width: 100%;
	height: 22px;
	overflow: hidden;
}
	#list-dir{
		padding-top: 5px;
	}

</style>
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
@endpush

@push( 'script' )
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLFiles.jquery.js') }}"></script>
<script>
$("body").OLFiles({
	actionListFolders : "{{ Route('files-get-all') }}",
	actionCreateFolder : "{{ Route('create-folder') }}",
	actionOpenFile : '/nada',
	actionSendFile : "{{ Route('send-files') }}",
	initialFolder : "public/"
});
</script>


@endpush
