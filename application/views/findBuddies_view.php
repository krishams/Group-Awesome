<h1>Find Buddies</h1>
<?php
        echo '<div id="findBuddies"><h2>Search by Name:</h2>';

        $attributes = array('method' => 'post');
        echo form_open('main/searchUserButton/',$attributes);
        echo '<li><input type="text" name="search" onkeyup="showResult(this.value)"/> </li>
    	<li><input type="submit" value="Search user" /> </li>';
    	echo form_close();
        echo '</div>';

        $bar_options = '<div><h2>Find buddies at your favorite bars!</h2><select id = "search_bar_users">';
        $bar_options .= '<option selected="selected">--</option>';
        foreach($favorite_bars as $bar) {
            $bar_options .= '<option id = "' . $bar['bar_id'] . '">' . $bar['name'] . '</option>';
        }
        $bar_options .= '</select></div>';

        echo $bar_options;
?>
<div id = "search_results">results:</div>

<div id = "randomUsers"><h1>Random Users</h1>

   <?php
        foreach($random as $row)
        {
           echo '<a href="'.base_url().'user/showProfile/'.$row['user_id'].'"><img width="155px" height="180px" src="'.$row['path'].'"></a>';
        }
   ?>

</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/search.js"></script>