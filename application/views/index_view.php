<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<div id="logon">
    <table>
        <tr>
            <td>Email:</td>
        </tr>
        <tr>
            <td><input type="text" name="emailfield" size="30"/></td>
        </tr>
        <tr>
            <td>Password:</td>
        </tr>
        <tr>
            <td><input type="password" name="passwfield" size="30" /></td>
        </tr>
        <tr>
            <td><input type="submit" value="Sign in"/><td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo anchor('main_controller/getRegistration', "Don't have an account?"); ?></td>
        </tr>
        <tr>
            <td><?php echo anchor('main_controller/getRequestPassword', 'Forgot your password?'); ?></td>
        </tr>
        
    </table>

</div>

