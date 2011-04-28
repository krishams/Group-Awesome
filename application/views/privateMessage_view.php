<h1>Send a Message</h1>
<?php
$hidden = array('msg_to' => $user);
echo form_open("message/sendPrivateMessage", '', $hidden); ?>
<table>
	<tr>
		<td>Subject:</td>
	</tr>
	<tr>
		<td><?php echo form_input('msg_sub', set_value('msg_sub', ''));?></td>
	</tr>
	<tr>
		<td>Message:</td>
	</tr>
	<tr>
		<td><?php $cdata = array('name' => 'msg_msg', 'cols' => '20', 'rows' => '4');
echo form_textarea($cdata, set_value('msg_msg', '')); ?></td>
	</tr>
	<tr>
		<td> </td>
	</tr>
	<tr>
		<td><input type="submit" value="Send message" /></td>
	</tr>
</table>
<?php echo form_close(); ?>

<!-- Is used to display type in errors-->
<?php echo validation_errors('<p class="error">'); ?>