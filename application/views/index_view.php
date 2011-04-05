<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<div id="logon">
    
    <p>Welcome to Pub Crawl </p>

    <table>
        <tr>
            <td>Email</td><td><input type="text" name="emailfield" size="30"/></td>
        </tr>
        <tr>
            <td>Password</td><td><input type="password" name="passwfield" size="30" /></td>
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

</div>

