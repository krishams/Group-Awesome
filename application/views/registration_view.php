This is the registration view
<!--
    In the following line of code we are making a tabel that will contain
    the fields that the user should fill out in order to registre to the page
-->
<div class="registrationDiv">
    <form class="registrationForm" action="submitRegistration" method="POST">
        <table class="registrationTabel">
            <tr>
                <td>First name:</td>
                <td><?php echo form_input('firstname','');?></td>
            </tr>
            <tr>
                <td>Last name:</td>
                <td><?php echo form_input('lastname','');?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo form_input('email','');?></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><?php echo form_password('passw','');?></td>
            </tr>
            <tr>
                <td>Confirm password:</td>
                <td><?php echo form_password('confirmPassw');?></td>
            </tr>
        </table>

        Her skal der være en captcha funktion: linket her kan hjælpe med det http://codeigniter.com/user_guide/helpers/captcha_helper.html
        <br />
        <input type="submit" value="Submit registration" />

        <!-- Is used to display type in errors-->
        <?php echo validation_errors('<p class="error">'); ?>
        
        <?php
            if($this->session->flashdata('error')){
                echo "<div class='errorMessage'>";
                echo $error;
                echo "</div>";
            }
        ?>
    </form>
</div>