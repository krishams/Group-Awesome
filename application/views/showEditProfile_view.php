<h2>Edit profile view</h2>

<form name='input' action='<?php echo base_url()?>user/editProfile' method='post'>
	<table>
		<tr>
			<td>Firstname:</td><td><input type='text' name='firstname' value='<?php echo $profile['f_name']?>'/></td>
		</tr>
		<tr>
			<td>Lastname:</td><td><input type='text' name='lastname' value='<?php echo $profile['l_name']?>'/></td>
		</tr>
		<tr>
			<td>E-Mail:</td><td><input type='text' name='email' value='<?php echo $profile['email']?>'/></td>
		</tr>
		<tr>
			<td>Old password:</td><td><input type='password' name='Oldpsw'/></td>
		</tr>
		<tr>
			<td>New password:</td><td><input type='password' name='passw'/></td>
		</tr>
		<tr>
			<td>New password again:</td><td><input type='password' name='confirmPassw'/></td>
		</tr>
		<tr>
			<td><input type='Submit' value='Save Changes'</td>
		</tr>				
	</table>
	<?php echo validation_errors('<p class="error">'); ?>

        <?php echo anchor('upload/getupload', 'Change profile picture') ?>
</form>
<?php
            if($this->session->flashdata('error')){
                echo "<div class='errorMessage'>";
                echo $this->session->flashdata('error');
                echo "</div>";
            }
        ?>

