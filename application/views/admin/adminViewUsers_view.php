<table class="adminEditUsersTable" border="1">
    <tr>
        <th>Id</th>
        <th>First name</th>
        <th>Last name</th>
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
    foreach($admin as $row2){
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
            <td><?= $row['id']; ?></td>

            <td><input type='text' name='firstname<?= $row['id']?>' size="10" value='<?= $row['f_name']?>'/></td>

            <td><input type='text' name='lastname<?= $row['id']?>' size="15" value='<?= $row['l_name'] ?>'/></td>

            <td><input type='text' name='email<?= $row['id']?>' value='<?= $row['email'] ?>'/></td>

            <td>
            <input type="submit" name="option" value="Change password"/>
        </td>

        <td><?= form_dropdown('roleid'.$row['id'], $roleOptions, $row['role_id']); ?></td>

        <td><?= form_checkbox('isactive'.$row['id'], '', $row['active']); ?></td>

        <td>
            <?php
            //makes sure that only a super admin can delete an admin
            if (($row['role_id'] == 1&& !$editAdmin)||($row['role_id'] == 2 && !$editAdmin)) {
                
            } else { ?>
                <input type="submit" name="option" value="Delete"/>
                <?php } ?>
        </td>
        <td>
            <?php
            //makes sure that only a super admin can edit an admin
            if (($row['role_id'] == 1&& !$editAdmin)||($row['role_id'] == 2 && !$editAdmin)) {
                
            } else { ?>
                <input type="submit" name="option" value="Edit"/>
            <?= form_close();
            } ?>
        </td>
        <td>
            More
        </td>
    </tr>
<?php } ?>
</table>