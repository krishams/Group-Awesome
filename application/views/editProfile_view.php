
        <?php
        	echo "<form name='input' action='html_form_action.asp' method='get'>";
			echo "Username: <input type='text' name='user' />";
			echo "<input type='submit' value='Submit' />";
			echo "</form>";
        	
        	echo $profile['email'];
			echo $profile['f_name'];
			echo $profile['l_name'];
			

        ?>
   