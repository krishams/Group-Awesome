<?php

foreach ($searchdata as $row) {
    echo anchor('user/showProfile/'.$row['id'],$row['f_name'] ." ". $row['l_name']);
    echo '<br/>';
}
?>