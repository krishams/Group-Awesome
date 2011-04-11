<ul class="headerUl">
    <li><a class="navigationBar" href="<?php echo base_url()?>main/goHome" >Home</a></li>
    <li><a class="navigationBar" href="<?php echo base_url()?>user/showProfile/<?php echo $_SESSION['userid']; ?>">Profile</a></li>
    <li><a class="navigationBar" href="<?php echo base_url()?>user/showEditProfile/<?php echo $_SESSION['userid']; ?>">Account</a></li>
    <li><a class="navigationBar" href="<?php echo base_url()?>main/logOut" >Log out</a></li>
    <li><a class="navigationBar" href="<?php echo base_url()?>admin/login">Admin login</a></li>
</ul>
