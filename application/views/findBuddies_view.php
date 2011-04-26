<div id="findBuddies">
   <h1>Random people</h1>
   <br/>

   <?php
        foreach($random as $row)
        {
           echo '<a href="'.base_url().'user/showProfile/'.$row['user_id'].'"><img src="'.$row['path'].'"></a>';
        }
   ?>

</div>
