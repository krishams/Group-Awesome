

</div> <!-- end wrapper -->
<ul>  
    <li class="<?= ($this->uri->segment(2) === 'login') ? 'active' : '' ?>">><a class="seemore" href="<?php echo base_url() ?>admin/login">Admin login</a></li>
</ul>
</body>

<!--
 This script should be in another class, because it is bad code to have it here.
 The script makes some more information about the user, display beneath the information that already is there.
-->
<script type="text/javascript">
    $('.seemore').click(function() {
        $('.hiddentr').toggle('slow', function() {
            // Animation complete.
        });
    });
</script>
</html>

