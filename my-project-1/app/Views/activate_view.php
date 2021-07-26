<?php $page_session= \CodeIgniter\Config\Services::session();?>
<?= $this->extend('layouts/base'); ?>

<?= $this->section('content');?>

	<div class="container">
		<h1>Activation Link</h1>
		<?php if(isset($error)):?>
			<div class="alert alert-danger">
				<?= $error;?>
			</div>
		<?php endif;?>	

		<?php if(isset($success)):?>
			<div class="alert alert-success">
				<?= $success;?>
			</div>
		<?php endif;?>	
	</div>
<?= $this->endSection();?>