<?php
$hidden = array('msg_to' => $user, 'uri'=>$this->uri->uri_string());
echo form_open("user/sendPrivateMessage", '', $hidden); ?>
Subject: <input type="text" name="msg_sub"/> <br/>
Message: <br/>
<textarea name="msg_msg" rows="4" cols="20"></textarea> <br/>

<input type="submit" value="Send message" />
<?php echo form_close(); ?>

<!-- Is used to display type in errors-->
<?php echo validation_errors('<p class="error">'); ?>