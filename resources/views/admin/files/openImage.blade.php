<div class="modal-edit-image">
	<!-- Hidden -->
	<input name="hidden_image" type="hidden" value="">
	<input name="action_image_rename" type="hidden" value="{{ Route('files-image-rename') }}">
	<input name="method_image_rename" type="hidden" value="PATCH">
	<input name="action_delete_file" type="hidden" value="{{ Route('files-image-delete') }}">
	<input name="action_delete_folder" type="hidden" value="{{ Route('files-folder-delete') }}">
	<input name="action_edit_image" type="hidden" value="{{ Route('files-image-update') }}">
	<div class="image-content">
		<header>
			<div class="row">
				<div class="col-md-8">
					<div class="input-group">
						<span class="input-group-addon" id="view_folder">/storage/</span>
						<input type="text" class="form-control" name="view_image" value="">
						<span class="input-group-btn">
							<button class="btn btn-default btn-rename-send" type="button">Renomear</button>
						</span>
					</div>
				</div>
			</div>
		</header>
		<section>
			<div class="row">
				<div class="edit-image col-md-8">
					<img id="image" src="">
				</div>
				<div class="action-image col-md-4">
					<div class="docs-preview clearfix">
						<h3>Visualizar</h3>
						<div class="img-preview preview-lg" style="width: 256px; height: 144px;">
							<img src="">
						</div>
					</div>
					<div class="docs-infos">
						<div class="input-group">
							<span class="input-group-addon w-fixed">URL</span>
							<input type="text" class="form-control w-fixed" name="image_data_url" placeholder="Url"
								readonly>
						</div>
						<div class="form-inline">
							<div class="form-group">
								<input type="text" class="form-control" name="image_size_width" data-value=""
									data-target="image_size_height" placeholder="width">
							</div>
							<div class="form-group">
								<button class="btn btn-default btn-scale-image active">X</button>
								<input type="text" class="form-control" name="image_size_height" data-value=""
									data-target="image_size_width" placeholder="height">
							</div>
							<button type="button" class="btn btn-default btn-resize-image">OK</button>
						</div>

						<div class="checkbox">
							<label>
								<input name="methodSave" type="checkbox" checked> Salvar como uma cópia do arquivo
								original
							</label>
						</div>
					</div>
				</div>
			</div>
		</section>
		<footer class="text-right">
			<div class="row">
				<div class="col-md-6 docs-buttons">
					<div class="btn-group">
						<button type="button" class="btn btn-sm btn-flat btn-default" data-method="setDragMode"
							data-option="move" title="Move">
							<span>
								<span class="fa fa-arrows"></span>
							</span>
						</button>
						<button type="button" class="btn btn-sm btn-flat btn-default" data-method="setDragMode"
							data-option="crop" title="Crop">
							<span>
								<span class="fa fa-crop"></span>
							</span>
						</button>
						<button type="button" class="btn btn-sm btn-flat btn-default" data-method="reset" title="Reset">
							<span>
								<span class="fa fa-refresh"></span>
							</span>
						</button>
						<button type="button" class="btn btn-sm btn-flat btn-default" data-method="clear" title="Clear">
							<span>
								<span class="fa fa-remove"></span>
							</span>
						</button>
					</div>

					<div class="btn-group">
						<button type="button" class="btn btn-sm btn-flat btn-default" data-method="rotate"
							data-option="-45" title="Rotate Left">
							<span>
								<span class="fa fa-rotate-left"></span>
							</span>
						</button>
						<button type="button" class="btn btn-sm btn-flat btn-default" data-method="rotate"
							data-option="45" title="Rotate Right">
							<span>
								<span class="fa fa-rotate-right"></span>
							</span>
						</button>
					</div>
					<div class="btn-group">
						<button type="button" class="btn btn-sm btn-flat btn-default" data-method="scaleX"
							data-option="-1" title="Flip Horizontal">
							<span>
								<span class="fa fa-arrows-h"></span>
							</span>
						</button>
						<button type="button" class="btn btn-sm btn-flat btn-default" data-method="scaleY"
							data-option="-1" title="Flip Vertical">
							<span>
								<span class="fa fa-arrows-v"></span>
							</span>
						</button>
					</div>
				</div>
				<div class="col-md-6">
					<button class="btn btn-sm btn-flat btn-primary btn-save-edit-image">Salvar</button>
					<button class="btn btn-sm btn-flat btn-warning btn-close-edit-image">Cancelar</button>
				</div>
			</div>
		</footer>
	</div>
</div>