<ul class="headerUl">
    <li class="<?=($this->uri->segment(2)==='index')?'active':''?>"> ><a class="navigationBar" href="<?php echo base_url()?>main/index" >Home</a></li>
    <li class="<?=($this->uri->segment(2)==='showProfile')?'active':''?>">><a class="navigationBar" href="<?php echo base_url()?>user/showProfile/<?php echo $_SESSION['userid']; ?>">Profile</a></li>
    <li class="<?=($this->uri->segment(2)==='showEditProfile')?'active':''?>">><a class="navigationBar" href="<?php echo base_url()?>user/showEditProfile/<?php echo $_SESSION['userid']; ?>">Settings</a></li>
  <li class="<?=($this->uri->segment(2)==='findBuddies')?'active':''?>"> ><a class="navigationBar" href="<?php echo base_url()?>search/findBuddies" >Find buddies</a></li>
    <li class="<?=($this->uri->segment(2)==='logOut')?'active':''?>">><a class="navigationBar" href="<?php echo base_url()?>main/logOut" >Log out</a></li>
    <li class="<?=($this->uri->segment(2)==='login')?'active':''?>">><a class="navigationBar" href="<?php echo base_url()?>admin/login">Admin login</a></li>
</ul>
