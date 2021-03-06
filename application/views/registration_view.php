<!--
    In the following line of code we are making a tabel that will contain
    the fields that the user should fill out in order to registre to the page
-->
<div class="registrationDiv">
    <form class="registrationForm" action="submitRegistration" method="POST">
        <table class="registrationTabel">
            <tr>
                <td>First name:</td>
                <td><?php echo form_input('firstname', set_value('firstname', ''));?></td>
            </tr>
            <tr>
                <td>Last name:</td>
                <td><?php echo form_input('lastname', set_value('lastname', ''));?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo form_input('email', set_value('email', ''));?></td>
            </tr>
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
            <td><input type="submit" value="Submit registration" /><td>
        	</tr>
        </table>

        <!--Her skal der være en captcha funktion: linket her kan hjælpe med det http://codeigniter.com/user_guide/helpers/captcha_helper.html
        -->
        <br />

        <?php echo anchor('', 'Back to sign in') ?>

        <!-- Is used to display type in errors-->
        <?php echo validation_errors('<p class="error">'); ?>
        
        <?php
            if($this->session->flashdata('error')){
                echo "<div class='errorMessage'>";
                echo $this->session->flashdata('error');
                echo "</div>";
            }
        ?>
    </form>
</div>