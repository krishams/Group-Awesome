<h2>profile view</h2>

<div id="profile">
    <img alt="Profile image"  src="
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
<div id="inbox-button">
    <?php if ($_SESSION['userid'] == $profile['id']) {
        echo form_open('user/goToInbox', ''); ?>
        <input type="submit" value="Inbox" />
    <?= form_close();
    } ?>
</div>
<div id="friendrequest-button">
    <?php if ($_SESSION['userid'] != $profile['id']) {
        $hidden = array('id' => $profile['id']);
        echo form_open('user/sendFriendRequest','', $hidden); ?>
        <input type="submit" value="Friend request" />
    <?= form_close();
    } ?>
</div>