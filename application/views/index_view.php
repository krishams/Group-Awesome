<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->

<div id="logon">
    <!--?php form_open('getHome()'); ?>-->
    <form class="loginForm" action="<?php echo base_url() . 'main/login'?>" method="POST">
        <table>
            <tr>
                <td><?=$mail?></td>
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
                <td><?=$password?></td>
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
                <td><input type="submit" value="<?php echo $sign_in ?>"/></td>
            </tr>
            <tr>
                <td><?php echo anchor('login/getRegistration', $sign_up); ?></td>
            </tr>
            <tr>
                <td><?php echo anchor('login/getRequestPassword', $forgot_pw); ?></td>
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

