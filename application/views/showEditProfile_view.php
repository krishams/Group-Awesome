<h1>Basic Information</h1>
<?php echo validation_errors(); ?>
<div id="profile-wrapper">
<div id="profile1">
            <img width="130px" height="150px" alt="Profile image"  src="
            <?php
                if(empty($pic_path))
                {
                    echo base_url() . "assets/img/avatar.svg";
                }
                else if(isset($pic_path))
                {
                    echo $pic_path['path'];
                }
            ?>
           "/>
              <?php echo anchor('upload/getupload', 'Change profile picture') ?>
        </div> <!-- profile -->

<form name='input' action='<?php echo base_url()?>user/editProfile' method='post'>
	<table>
		<tr>
			<td>Firstname:</td><td><input type='text' name='firstname' value='<?php echo $profile['f_name']?>'/></td>
		</tr>
		<tr>
			<td>Lastname:</td><td><input type='text' name='lastname' value='<?php echo $profile['l_name']?>'/></td>
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
			<td></td><td><input type='Submit' value='Save Changes'</td>
		</tr>				
	</table>
	
</form>
</div>


      

       <?php

            if($this->session->flashdata('error')){
                echo "<div class='errorMessage'>";
                echo $this->session->flashdata('error');
                echo "</div>";
            }
        ?>




