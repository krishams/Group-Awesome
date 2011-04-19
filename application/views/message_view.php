<?php
    foreach($messages as $row): ?>
    <li class="message">
        <div class="msgbody">
            <?php echo $row['message']; ?>
        </div>
        <div class="msgauthor">
            <i> <?php echo $row['submitter']; ?> </i>
        </div>
        <div class="msgupdate">
            <?php echo $row['msg_date']; ?>
        </div>
        <a class="seemore">Reply to message</a>
        <div class="hiddentr" id="<?php echo $row['msg_id']; ?>" style="display: none">
        <?php
        $hiddenid = array('parent'=>$row['msg_id']);
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
        <?php
        if (isset($row['messages'])) { ?>
                <ul class="comments">
                <?php indsetcomm($row['comments']); ?>
                </ul>
        <?php
        } ?>
    </li>
<?php endforeach; ?>