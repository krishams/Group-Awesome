<?php
$hidden = array('msg_to' => $user);
echo form_open("message/sendPrivateMessage", '', $hidden); ?>
Subject:  <?php echo form_input('msg_sub', set_value('msg_sub', ''));?><br/>
Message: <br/>
<?php $cdata = array('name' => 'msg_msg', 'cols' => '20', 'rows' => '4');
echo form_textarea($cdata, set_value('msg_msg', '')); ?>
<br/>
<input type="submit" value="Send message" />
<?php echo form_close(); ?>

<!-- Is used to display type in errors-->
<?php echo validation_errors('<p class="error">'); ?>