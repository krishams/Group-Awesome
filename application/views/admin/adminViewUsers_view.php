<table class="adminEditUsersTable" border="1">
    <tr>
        <th>Id</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Role</th>
        <th>Is admin</th>
        <th>Active</th>
    </tr>

    <?php
    $activeOptions = array('0' => 'False', '1' => 'True');
    $roleOptions = array();
    foreach ($permissions as $row1) {
        // echo $row1['role_id'] . ' - ' . $row1['role_name'];
        $roleOptions[$row1['role_id']] = $row1['role_name'];
    };

    foreach ($users as $row) {
    ?>
        <tr>
            <td><?= $row['id']; ?></td>

            <td><input type='text' name='firstname' value='<?= $row['f_name']; ?>'/></td>

            <td><input type='text' name='lastname' value='<?= $row['l_name']; ?>'/></td>

            <td><input type='text' name='email' value='<?= $row['email'] ?>'/></td>

            <td>
            <?php
            $hidden = array('email' => $row['email']);
            echo form_open('login/submitRequestPassword', '', $hidden); ?>
            <input type="submit" value="Change password"/>
            <?= form_close(); ?>
        </td>

        <td><?= form_dropdown('role_id', $roleOptions, $row['role_id']); ?></td>

        <!-- This one should be removed, it will be checked on the role_id instead -->
        <td><?= form_dropdown('is_admin', $activeOptions, $row['is_admin']); ?></td>

        <td><?= form_dropdown('is_active', $activeOptions, $row['active']); ?></td>
    </tr>
    <?php } ?>
</table>