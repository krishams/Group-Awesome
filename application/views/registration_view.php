This is the registration view
<!--
    In the following line of code we are making a tabel that will contain
    the fields that the user should fill out in order to registre to the page
-->
<div class="registrationDiv">
    <form class="registrationForm" action="user_controller/submitRegistration" method="POST">
        <table class="registrationTabel">
            <tr>
                <td>First name:</td>
                <td><input type="text" name="firstname" /></td>
            </tr>
            <tr>
                <td>Last name:</td>
                <td><input type="text" name="lastname" /></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" /></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="pass" /></td>
            </tr>
            <tr>
                <td>Confirm password:</td>
                <td><input type="password" name="passconfirm" /></td>
            </tr>
        </table>

        Her skal der være en captcha funktion: linket her kan hjælpe med det http://codeigniter.com/user_guide/helpers/captcha_helper.html
        <br />
        <input type="submit" value="Submit registration" />
    </form>
</div>
<?php
// put your code here
?>