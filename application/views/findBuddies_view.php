<h1>Find Buddies</h1>
<?php
    echo '<div id="findBuddies"><h2>Find them from your favorite bars or search them by name:</h2>';

    $attributes = array('method' => 'post');
    echo form_open('main/searchUserButton/',$attributes);
    echo '<div id="innerBuddies"><li><input type="text" name="search" id="searchString" onkeyup="showResult(this.value)"/></li>
    <li><input type="submit" value="Search" id="search_user_by_name" /> </li>';
    echo form_close();

    $bar_options = '<select id = "search_bar_users">';
    $bar_options .= '<option class = "kill" selected="selected">--</option>';
    foreach($favorite_bars as $bar) {
        $bar_options .= '<option id = "' . $bar['bar_id'] . '">' . $bar['name'] . '</option>';
    }
    $bar_options .= '</select></div>';
    echo $bar_options;
    echo '<div id = "search_results"></div></div>';
?>

<div id = "randomUsers"><h2>Or just browse a random friend:</h2>

<?php
    foreach($random as $row)
    {
       echo '<div id="profile"><a href="'.base_url().'user/showProfile/'.$row['user_id'].'"><img width="130px" height="150px" src="'.$row['path'].'"></a></div>';
    }
?>

</div>
<script type="text/javascript"> base_url = <?php echo '"' . base_url() . '"'; ?>;</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/search.js"></script>
