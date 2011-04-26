<ul class="headerUl">
    <li class="<?=($this->uri->segment(2)==='index')?'active':''?>"><a class="navigationBar" href="<?php echo base_url()?>main/index" >Home</a></li>
    <li class="<?=($this->uri->segment(2)==='showProfile')?'active':''?>"><a class="navigationBar" href="<?php echo base_url()?>user/showProfile/<?php echo $_SESSION['userid']; ?>">Profile</a></li>
    <li class="<?=($this->uri->segment(2)==='editProfile')?'active':''?>"><a class="navigationBar" href="<?php echo base_url()?>user/editProfile/<?php echo $_SESSION['userid']; ?>">Settings</a></li>
    <li class="<?=($this->uri->segment(2)==='findBuddies')?'active':''?>"><a class="navigationBar" href="<?php echo base_url()?>search/findBuddies" >Find buddies</a></li>
    <li class="<?=($this->uri->segment(2)==='logOut')?'active':''?>"><a class="navigationBar" href="<?php echo base_url()?>main/logOut" >Log out</a></li>

</ul>
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/home.js"></script>