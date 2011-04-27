<h1>Profile View</h1>
<div id="profile-wrapper2">
<div id="profile-left">
    <?php
    echo $profile['email'] . '</br>';
    echo $profile['f_name'] . '</br>';
    echo $profile['l_name'] . '</br></br>';
    if ($isUser) {
        echo form_open('message/goToInbox', '');
        echo '<input type="submit" value="My inbox" />';
    	echo form_close();
    }
    ?>
</div>

<div id="profile">
    <img width="130px" height="150px" alt="Profile image"  src="
    <?php
    if (empty($pic_path)) {
        echo base_url() . "assets/img/avatar.svg";
    } else if (isset($pic_path)) {
        echo $pic_path['path'];
    }
    ?>
         "/>
</div> <!-- profile -->
</div>  
<div class="clear"></div>

<div id="friendrequest-button">
    <?php if (!$isUser&&!$isFriend) {
        $hidden = array('id' => $profile['id']);
        echo form_open('message/sendFriendRequest','', $hidden); ?>
        <input type="submit" value="Friend request" />
    <?php echo form_close();
    } ?>
</div>

<div id="sendMessage">
    <?php if(!$isUser){
        $hidden = array('id' => $profile['id']);
        echo form_open('message/getPrivateMsgView','',$hidden); ?>
        <input type="submit" value="Send private message" />
    <?php form_close(); }?>

</div>

<div id="myFriends">
    <br/>
    <h2>Buddies</h2>

    <?php
    foreach($friends as $row)
    {
        echo '<div id="profile"><a href="'.base_url().'user/showProfile/'.$row['id'].'"><img width="130px" height="150px" src="'.$row['path'].'"></a></div> ';
    }
    ?>
</div>