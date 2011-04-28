        <h1>Your Inbox</h1>
<?php
        if ($messages != null) {
            foreach ($messages as $row) {
                if ($row['msg_sub'] == 'friend request%&¤') { ?>
                    <div class="inboxMessages">
                    <p>You have been asked if you want to be friends with</p> <i><?php echo $row['submit_name']; ?></i>
                <?php
                    $hiddenid = array(
                        'msg_id' => $row['msg_id'],
                        'owner_id' => $row['submit_id'],
                        'submit_id' => $_SESSION['userid']);
                    echo form_open('user/createRelation', '', $hiddenid); ?>
                    <input type="submit" value="Accept friend request" />
                    </div>
        <?= form_close(); ?>
<?php } else { ?>
		<div class="inboxMessages">
        <li class="message">
            <div class="msgsub">
                <?php echo $row['msg_sub']; ?>
            </div>
            <div class="msgbody">
                <?php echo $row['message']; ?>
            </div>
            <div class="msgauthor">
                <i> <?php echo $row['submit_name']; ?> </i>
            </div>
            <div class="msgupdate">
                <?php echo $row['msg_date']; ?>
            </div>
            <a class="reply">Reply to message</a>
            <div class="hidden" id="<?php echo $row['msg_id']; ?>" style="display: none">
                <?php
                    $hiddenid = array(
                        'parent_id' => $row['msg_id'],
                        'owner_id' => $row['submit_id'],
                        'submit_id' => $_SESSION['userid']);
                    echo form_open("message/sendRepley", '', $hiddenid);
                ?>
                <fieldset>
                    <legend>New message</legend>
                    <label>Your message</label><textarea name="messagebody" rows="4" cols="20"></textarea><br />
                    <input type="submit" value="Submit reply">
                </fieldset>
                <?php echo form_close(); ?>
            </div>
        </li>
        </div>
    <?php }
            }
        } ?>
        
        <?php
            $hidden = array('uri' => $this->uri->uri_string());
            echo form_open("message/sendMessage", 'id="sendMessageForm"', $hidden); ?>
            <table>
    			<tr>
            		<td>To:</td> 
            	</tr>
            	<tr>
            		<td><?php echo form_input('msg_to', set_value('msg_to', '')); ?></td>
            	</tr>
            	<tr>
            		<td>Subject:</td>
            	</tr>
            	<tr>
            		<td><?php echo form_input('msg_sub', set_value('msg_sub', ''));?></td>
            	</tr>
            	<tr>
            		<td>Message:</tr>
            	</tr>
            	<tr>
            		<td><?php $cdata = array('name' => 'msg_msg', 'cols' => '20', 'rows' => '4');
            echo form_textarea($cdata, set_value('msg_msg', '')); ?></td>
            	</tr>
            	<tr>
            		<td><input type="submit" value="Send message" /></tr>
            	</tr>
            </table>
        <?= form_close(); ?>
        <!-- Is used to display type in errors-->
        <?php echo validation_errors('<p class="error">'); ?>