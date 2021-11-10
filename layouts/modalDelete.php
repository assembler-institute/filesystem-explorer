<?php


function renderModalDelete()
{
	$id = "modalDelete";
?>
	<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="<?= $id ?>" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-dark text-light">
					<h5 class="modal-title">Delete</h5>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="d-flex flex-column justify-content-center align-items-center" action="actions/delete/index.php" method="POST" enctype="multipart/form-data">
						<p class="fw-light fs-3 text-align-center">Are you sure to delete the next file?</p>
						<input name="path" type="hidden" id="input_delete_path" />
						<button class="btn btn-warning m-auto" type="submit">Delete</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
}
