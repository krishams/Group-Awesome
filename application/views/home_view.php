<div id="home">
<h1>Welcome to home</h1>

<?php
$attributes = array('method' => 'post');
echo form_open('main/searchUserButton/',$attributes);
?>
<input type="text" name="search" onkeyup="showResult(this.value)"/>
<input type="submit" value="Search user" />

<?php
echo form_close();
?>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/home.js"></script>