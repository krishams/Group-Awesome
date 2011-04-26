<br/><br/>
<?php

        $attributes = array('method' => 'post'); echo form_open('main/searchUserButton/',$attributes);
        echo '<li><input type="text" name="search" onkeyup="showResult(this.value)"/> </li>
    	<li><input type="submit" value="Search user" /> </li>';
    	echo form_close();
?>
<div id="findBuddies">
   <h1>Find Buddies</h1>
   <br/>

   <?php
        foreach($random as $row)
        {
           echo '<a href="'.base_url().'user/showProfile/'.$row['user_id'].'"><img width="155px" height="180px" src="'.$row['path'].'"></a>';
        }
   ?>

</div>
