<div class="uploadPic">

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="30" />

<br /><br />

<input type="submit" value="upload" />

<?php echo form_close(); ?>

<?php echo anchor('user/showEditProfile', 'back'); ?>

<?php echo $error;?>

</div>
