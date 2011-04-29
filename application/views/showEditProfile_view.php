<h1>Settings</h1>
<h2>Edit Your Profile</h2>
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

<div id="profile-info">
<form name='input' action='<?php echo base_url()?>user/editProfile' method='post'>
	<table id="float-right">
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
			<td></br></td>
		</tr>
		<tr>
			<td><input type='Submit' value='Save Changes'</td>
		</tr>				
	</table>
	<table id="float-left">
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
	</table>
	

</form>
</div>
</div>


<h2>Favorite bars</h2>
<form id="bars" action="destination.html">
	<select id="barsoption">
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
	<input type='Submit' value='Add favorite'>
</form>
<div id="addbar">
	<form id="addbarform" action="destination.html">
		<input type="text" id="barname"></input>
		<input type='Submit' value='Add Bar'>
	</form>
</div>
<a href="#" id="addbarshowhide">Is your bar missing? Add it to the list!</a>
 
<div id="search_results"></div>
       <?php

            if($this->session->flashdata('error')){
                echo "<div class='errorMessage'>";
                echo $this->session->flashdata('error');
                echo "</div>";
            }
        ?>



<script type="text/javascript"> base_url = <?php echo '"' . base_url() . '"'; ?>;</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bars.js"></script>
