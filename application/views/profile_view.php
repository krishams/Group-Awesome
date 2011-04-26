<h1>Profile View</h1>

<div id="profile">
    <img width="155px" height="180px" alt="Profile image"  src="
    <?php
    if (empty($pic_path)) {
        echo base_url() . "assets/img/avatar.svg";
    } else if (isset($pic_path)) {
        echo $pic_path['path'];
    }
    ?>
         "/>
</div> <!-- profile -->

<div id="profile-left">
    <?php
    echo '</br>' . $profile['email'] . '</br>';
    echo $profile['f_name'] . '</br>';
    echo $profile['l_name'] . '</br>';
    ?>
</div>
<br/>
<div id="inbox-button">
    <?php if ($isUser) {
        echo form_open('user/goToInbox', ''); ?>
        <input type="submit" value="Inbox" />
    <?= form_close();
    } ?>
</div>

<div id="friendrequest-button">
    <?php if (!$isUser) {
        $hidden = array('id' => $profile['id']);
        echo form_open('user/sendFriendRequest','', $hidden); ?>
        <input type="submit" value="Friend request" />
    <?= form_close();
    } ?>
</div>