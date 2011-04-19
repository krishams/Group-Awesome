<?php function indsetcomm($maintemp){
    foreach($maintemp as $row): ?>
    <li class="message">
        <div class="msgbody">
            <?php echo $row['entrie']; ?>
        </div>
        <div class="msgauthor">
            <i> <?php echo $row['name']; ?> </i>
        </div>
        <div class="msgupdate">
            <?php echo $row['msg_date']; ?>
        </div>
        <a class="commentlink">Comment this link</a>
        <div class="commentingarea" id="<?php echo $row['id']; ?>" style="display: none">
        <?php
        $hiddenid = array('parent'=>$row['id']);
        echo form_open("welcome/comment_insert", '', $hiddenid);
        ?>
                <fieldset>
                        <legend>New message</legend>
                        <label>Your message</label><textarea name="messagebody" rows="4" cols="20"></textarea><br />
                        <input type="submit" value="Submit message">
                </fieldset>
        <?php
        echo form_close(); ?>
        </div>
        <?php
        if (isset($row['comments'])) { ?>
                <ul class="comments">
                <?php indsetcomm($row['comments']); ?>
                </ul>
        <?php
        } ?>
    </li>
<?php endforeach;
}
?>