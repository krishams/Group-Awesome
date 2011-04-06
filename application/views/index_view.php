<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<div id="logon">
    
    <p>Welcome to Pub Crawl </p>
    <!--?php form_open('getHome()'); ?>-->
    <form class="loginForm" action="index.php/main_controller/getHome" method="POST">
    <table>
        <tr>
            <td>Email</td>
            <td><?php $data = array(
                'name'=>'email',
                'value'=>'',
                'size'=>'30');
            echo form_input($data);?>
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td><?php $data = array(
                'name'=>'passw',
                'value'=>'',
                'size'=>'30');
            echo form_password($data);?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Sign in"/><td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo anchor('main_controller/getRegistration', 'Not signed up?'); ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo anchor('main_controller/getRequestPassword', 'Forgot your password?'); ?></td>
        </tr>
    </table>
        <?php
            if($this->session->flashdata('error')){
                echo "<div class='errorMessage'>";
                echo $error;
                echo "</div>";
            }
        ?>
    </form>
</div>

