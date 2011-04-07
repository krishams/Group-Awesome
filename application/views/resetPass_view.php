<div class="resetPassDiv">
    <?php echo form_open('main_controller/resetPassSuccess'); ?>
        <table class="resetTable">
            <input type="hidden" name="linkVal" value="<?php echo $linkval ?>" />
            <tr>
                <td>Password:</td>
                <td><?php echo form_password('passw','');?></td>
            </tr>
            <tr>
                <td>Confirm password:</td>
                <td><?php echo form_password('confirmPassw');?></td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Submit" /><td>
        	</tr>
        </table>
        <br />
        <?php echo anchor('', 'Back to sign in') ?>
        <!-- Is used to display type in errors-->
        <?php echo validation_errors('<p class="error">'); ?>

    <?php echo form_close(); ?>
</div>