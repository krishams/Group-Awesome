<?php

foreach ($searchdata as $row) {
    echo anchor('main_controller/showProfile/'.$row['id'],$row['f_name'] ." ". $row['l_name']);
    echo '<br/>';
}
?>