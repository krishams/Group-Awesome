<!-- Is used to display type in errors-->
<?php echo validation_errors('<p class="error">'); ?>
<table>
    <td>
        <h1>Send a Message</h1>
        <?php
            $hidden = array('uri' => $this->uri->uri_string());
            echo form_open("message/sendMessage", '', $hidden); ?>
            To: <input type="text" name="msg_to"/> <br/>
            Subject: <input type="text" name="msg_sub"/> <br/>
            Message: <br/>
            <textarea name="msg_msg" rows="4" cols="20"></textarea> <br/>
            <input type="submit" value="Send message" />
        <?= form_close(); ?>
        
    </td>
    <td>
        <?php
        if ($messages != null) {
            foreach ($messages as $row) {
                echo '<br/> ----------------------------------- <br/>';
                if ($row['msg_sub'] == 'friend request%&¤') { ?>
                    You have been asked if you want to be friends with <i><?php echo $row['submit_name']; ?></i>
                <?php
                    $hiddenid = array(
                        'msg_id' => $row['msg_id'],
                        'owner_id' => $row['submit_id'],
                        'submit_id' => $_SESSION['userid']);
                    echo form_open('user/createRelation', '', $hiddenid); ?>
                    <input type="submit" value="Accept friend request" />
        <?= form_close(); ?>
<?php } else { ?>
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
    <?php }
            }
        } ?>
</td>
</table>
