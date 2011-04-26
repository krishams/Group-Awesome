<div id="findBuddies">
   <h1>Random people</h1>
   <br/>

   <?php
        foreach($random as $row)
        { ?>
            <img src="<?php echo $row['path'];?> "/>
   <?php
        }
   ?>

</div>