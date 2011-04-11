<ul class="headerUl">
    <li><a class="navigationBar" href="<?php echo base_url()?>main_controller/goHome" >Home</a></li>
    <li><a class="navigationBar" href="<?php echo base_url()?>user_controller/showProfile/<?php echo $_SESSION['userid']; ?>">Profile</a></li>
    <li><a class="navigationBar" href="<?php echo base_url()?>user_controller/editProfile/<?php echo $_SESSION['userid']; ?>">Account</a></li>
    <li><a class="navigationBar" href="<?php echo base_url()?>main_controller/logOut" >Log out</a></li>
</ul>
