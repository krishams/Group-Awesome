<div id="findBuddies">
   <h1>Random people</h1>
   <br/>

   <?php
        foreach($random as $row)
        { ?>
            <img alt="Profile image" src="<?php echo $row['path'];?> "/>
            <p><?php echo $row['user_id']; ?></p>
   <?php
        }
   ?>

</div>