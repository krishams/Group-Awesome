<?= form_open("user/sendMessage"); ?>
To: <input type="text" name="msg_to"/> <br/>
Subject: <input type="text" name="msg_sub"/> <br/>
Message: <br/>
<textarea name="msg_msg" rows="4" cols="20"></textarea> <br/>

<input type="submit" value="Send message" />
<?= form_close(); ?>

       <?php
       if ($messages != null) {
           foreach ($messages as $row) {
               if($row['msg_sub'] == 'friend request%&¤'){ ?>
                    You have been ask if you want to be friends with <?php echo $row['submit_name']; ?>
                    <?php $hiddenid = array(
                        'msg_id' => $row['msg_id'],
                        'owner_id' => $row['submit_id'],
                        'submit_id' => $_SESSION['userid']);
                        echo form_open('user/createRelation', '', $hiddenid); ?>
                        <input type="submit" value="Accept friend request" />
                    <?= form_close(); ?>
               <?php }
               else{ ?>
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
                   'parent' => $row['msg_id'],
                   'owner_id' => $row['submit_id'],
                   'submit_id' => $_SESSION['userid']);
               echo form_open("user/sendRepley", '', $hiddenid);
        ?>
               <fieldset>
                   <legend>New message</legend>
                   <label>Your message</label><textarea name="messagebody" rows="4" cols="20"></textarea><br />
                   <input type="submit" value="Submit reply">
               </fieldset>
        <?php echo form_close(); ?>
           </div>
       </li>
<?php } }
       } ?>