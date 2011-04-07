<div class="requestpassDiv">
    <form class="requestpassForm" action="submitRequestPassword" method="POST" >
        <table class="requestpassTabel">

            <tr>
            	<td>Email:</td>
                <td><?php echo form_input('email','');?></td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Submit" /><td>
        	</tr>
        </table>
    </form>

    <?php echo anchor('', 'Back to sign in'); ?>

     <?php echo validation_errors('<p class="error">'); ?>
</div>


