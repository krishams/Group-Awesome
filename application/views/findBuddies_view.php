<h1>Find Buddies</h1>
<div id = "search_results"></div>
<?php
    echo '<div id="findBuddies"><h2>Search by Name:</h2>';

    $attributes = array('method' => 'post');
    echo form_open('main/searchUserButton/',$attributes);
    echo '<li><input type="text" name="search" id="searchString" onkeyup="showResult(this.value)"/></li>
    <li><input type="submit" value="Search" id="search_user_by_name" /> </li>';
    echo form_close();
    echo '</div>';

    $bar_options = '<div><h2>Find buddies at your favorite bars!</h2><select id = "search_bar_users">';
    $bar_options .= '<option class = "kill" selected="selected">--</option>';
    foreach($favorite_bars as $bar) {
        $bar_options .= '<option id = "' . $bar['bar_id'] . '">' . $bar['name'] . '</option>';
    }
    $bar_options .= '</select></div>';

    echo $bar_options;
?>

<div id = "randomUsers"><h1>Random Users</h1>

<?php
    foreach($random as $row)
    {
       echo '<a href="'.base_url().'user/showProfile/'.$row['user_id'].'"><img width="130px" height="150px" src="'.$row['path'].'"></a>';
    }
?>

</div>
<script type="text/javascript"> base_url = <?php echo '"' . base_url() . '"'; ?>;</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/search.js"></script>
