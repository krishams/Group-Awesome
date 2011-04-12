<?php

foreach ($searchdata as $row) {
    echo anchor('main/showProfile/'.$row['id'],$row['f_name'] ." ". $row['l_name']);
    echo '<br/>';
}
?>