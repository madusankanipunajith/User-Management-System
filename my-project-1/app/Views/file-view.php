<?php $page_session= \CodeIgniter\Config\Services::session();?>
<?= $this->extend('layouts/base'); ?>

<?= $this->section('content');?>

	<div class="container">
		<h1>Welcome to file uploading</h1>
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
		 <?= form_open_multipart();?>

		<?php if(isset($validation)):?>
                	<span class="text-danger"><?= display_error($validation, 'avatar');?></span>
        <?php endif;?>
  		<div class="md-form" action="#">
  		<div class="file-field d-flex align-items-center">
    		<div class="btn btn-primary btn-sm float-left">
      		<span>Choose files</span>
      		<input type="file" name="avatar" multiple>
    		</div>
    		<input class="ml-2" type="submit" value="Upload">
  		</div>
		</div>
		<br><br><br>

		 <?= form_close(); ?>	
	</div>
<?= $this->endSection();?>