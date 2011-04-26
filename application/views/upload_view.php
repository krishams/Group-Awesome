<h1>Upload a Picture</h1>
<div class="uploadPic">

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="30" />

<br /><br />

<input type="submit" value="upload" />

<?php echo form_close(); ?>

<?php
            if ($this->session->flashdata('error')) {
                echo "<div class='errorMessage'>";
                echo "<br />";
                echo $this->session->flashdata('error');
                echo "</div>";
            }
 ?>
<br/>

<p>Note: <br/>
    - The image: <br/>
        * size has to be less than: 1024 kilobytes<br/>
        * height max 180 pixel<br/>
        * width max 155 pixel</p>

<br />
<?php echo anchor('user/showEditProfile', 'Back to edit profile'); ?>


</div>
