<h1>Basic Information</h1>
<?php echo validation_errors(); ?>
<div id="profile">
            <img width="155px" height="180px" alt="Profile image"  src="
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
			<td>Firstname:</td>
		</tr>
		<tr>
			<td><input type='text' name='firstname' value='<?php echo $profile['f_name']?>'/></td>
		</tr>
		<tr>
			<td>Lastname:</td>
		</tr>
		<tr>
			<td><input type='text' name='lastname' value='<?php echo $profile['l_name']?>'/></td>
		</tr>
		
		<tr>
			<td>Old password:</td>
		</tr>
		<tr>
			<td><input type='password' name='Oldpsw'/></td>
		</tr>
		<tr>
			<td>New password:</td>
		</tr>
		<tr>
			<td><input type='password' name='passw'/></td>
		</tr>
		<tr>
			<td>New password again:</td>
		</tr>
		<tr>
			<td><input type='password' name='confirmPassw'/></td>
		</tr>
		<tr>
			<td>Street name:</td>
		</tr>
		<tr>
			<td><input type='text' name='s_name' value='<?php echo $profile['s_name']?>' /></td>
		</tr>
		<tr>
			<td>City:</td>
		</tr>
		<tr>
			<td><input type='text' name='city' value='<?php echo $profile['city']?>' /></td>
		</tr>
		<tr>
			<td>Zip:</td>
		</tr>
		<tr>
			<td><input type='text' name='zip' value='<?php echo $profile['zip']?>' /></td>
		</tr>
		<tr>
			<td>Age:</td>
		</tr>
		<tr>
			<td><input type='text' name='age' value='<?php echo $profile['age']?>'/></td>
		</tr>
		<tr>
			<td><input type='Submit' value='Save Changes'</td>
		</tr>				
	</table>
	

<h2>Favorite bars</h2>

	<select id="bars">
	<?php
		foreach ($bars as $bar) {
			echo '<option id="'; 
			echo $bar['id']; 
			echo '">';
			echo $bar['name'];
			echo '</option>';
		}
	?>
</select>
</form>  
<div id="content"><p>asdnfldjdfldjdfjkfdpkdfpd</p></div>
       <?php

            if($this->session->flashdata('error')){
                echo "<div class='errorMessage'>";
                echo $this->session->flashdata('error');
                echo "</div>";
            }
        ?>




<script type="text/javascript">
$("#content").load("<?php echo base_url();?> ajax/loadFavoritBars");
</script>

