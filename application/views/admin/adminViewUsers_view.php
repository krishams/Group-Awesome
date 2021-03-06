<br/>
<table class="adminEditUsersTable" border="1s">
    <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Password</th>
        <th>Role</th>
        <th>Active</th>
        <th>Delete</th>
        <th>Edit</th>
        <th>More</th>
    </tr>

    <?php
    $roleOptions = array();
    foreach ($admin as $row2) {
        $editUser = $row2['editUser'];
        $editAdmin = $row2['editAdmin'];
    }
    foreach ($permissions as $row1) {
        $roleOptions[$row1['role_id']] = $row1['role_name'];
    };

    foreach ($users as $row) {
        $hidden = array(
            'id' => $row['id']
        );
        echo form_open('admin/controlInput', '', $hidden);
    ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            
            <td><input type='text' name='email<?php echo $row['id'] ?>' value='<?php echo $row['email'] ?>'/></td>

            <td>
                <input type="submit" name="option" value="Change password"/>
            </td>

            <td><?php echo form_dropdown('roleid' . $row['id'], $roleOptions, $row['role_id']); ?></td>

            <td><?php echo form_checkbox('isactive' . $row['id'], '', $row['active']); ?></td>

            <td>
            <?php
            //makes sure that only a super admin can delete an admin
            if (($row['role_id'] == 1 && !$editAdmin) || ($row['role_id'] == 2 && !$editAdmin)) {
                
            } else {
            ?>
                <input type="submit" name="option" value="Delete"/>
            <?php } ?>
        </td>
        <td>
            <?php
            //makes sure that only a super admin can edit an admin
            if (($row['role_id'] == 1 && !$editAdmin) || ($row['role_id'] == 2 && !$editAdmin)) {
                
            } else {
            ?>
                <input type="submit" name="option" value="Edit"/>
            <?php } ?>
        </td>
        <td>
            <a class="seemore">More</a>
        </td>
    </tr>
    <tr class="hiddentr" name="hide" style="display: none">
    <div class="hidden" name="hide">
        <td ></td>

        <td colspan="7">
            <div>
                <table>
                <tr>
                    <td>First name:</td> <td><input type='text' name='firstname<?php echo $row['id'] ?>' size="15" value='<?php echo $row['f_name'] ?>'/></td>
                </tr>
                <tr>
                <td>Last name:</td> <td><input type='text' name='lastname<?php echo $row['id'] ?>' size="15" value='<?php echo $row['l_name'] ?>'/></td>
                </tr>
                </table>
            </div>
        </td>
    </div>

    </tr>
    <?php echo form_close();
        } ?>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin.js"></script>

