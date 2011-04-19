<?php
    foreach($messages as $row){?>
    <li class="message">
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
            'parent'=>$row['msg_id'],
            'owner_id'=>$row['submit_id'],
            'submit_id'=>$_SESSION['userid']);
        echo form_open("user/insertMessage", '', $hiddenid);
        ?>
                <fieldset>
                        <legend>New message</legend>
                        <label>Your message</label><textarea name="messagebody" rows="4" cols="20"></textarea><br />
                        <input type="submit" value="Submit reply">
                </fieldset>
        <?php
        echo form_close(); ?>
        </div>
    </li>
<?php } ?>