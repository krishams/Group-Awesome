<?php
$hidden = array('msg_to' => $user);
echo form_open("user/sendPrivateMessage", '', $hidden); ?>
Subject: <input type="text" name="msg_sub"/> <br/>
Message: <br/>
<textarea name="msg_msg" rows="4" cols="20"></textarea> <br/>

<input type="submit" value="Send message" />
<?= form_close(); ?>