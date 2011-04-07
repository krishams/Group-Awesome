<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<div id="logon">
    <!--?php form_open('getHome()'); ?>-->
    <form class="loginForm" action="index.php/main_controller/getHome" method="POST">
        <table>
            <tr>
                <td>Email</td>
            </tr>
            <tr>
                <td>
                    <?php
                    $data = array(
                        'name' => 'email',
                        'value' => '',
                        'size' => '30');
                    echo form_input($data);
                    ?>
                </td>
            </tr>
            <tr>
                <td>Password</td>
            </tr>
            <tr>
                <td><?php
                    $data = array(
                        'name' => 'passw',
                        'value' => '',
                        'size' => '30');
                    echo form_password($data);
                    ?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="submit" value="Sign in"/></td>
            </tr>
            <tr>
                <td><?php echo anchor('main_controller/getRegistration', 'Not signed up?'); ?></td>
            </tr>
            <tr>
                <td><?php echo anchor('main_controller/getRequestPassword', 'Forgot your password?'); ?></td>
            </tr>
        </table>
        <!--This code will only be used if the password or email is incorrect,
            gets the error code from main_model -> verifyUser -->
        <?php
            if ($this->session->flashdata('errorVerify')) {
                echo "<div class='errorMessage'>";
                echo "<br />";
                echo $this->session->flashdata('errorVerify');
                echo "</div>";
            }
        ?>
    </form>
</div>

