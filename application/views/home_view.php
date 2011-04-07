
<p>Welcome to home</p>

<?php

echo form_open('main_controller/searchUser');


echo form_input('search','');
?>

<input type="submit" value="Search user" />

<?php

echo form_close();?>
