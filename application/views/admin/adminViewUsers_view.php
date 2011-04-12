<table class="adminEditUsersTable" border="1">
    <tr>
        <th>Id</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Is admin</th>
        <th>Active</th>
    </tr>
    <?php 
        $options = array('0' => 'False', '1' => 'True');
        foreach ($users as $row) {
    ?>
        <tr>
            <td><?= $row['id']; ?></td>

            <td><input type='text' name='firstname' value='<?= $row['f_name']; ?>'/></td>

            <td><input type='text' name='lastname' value='<?= $row['l_name']; ?>'/></td>

            <td><input type='text' name='email' value='<?= $row['email']?>'/></td>

            <td>
            <?php
            $hidden = array('email' => $row['email']);
            echo form_open('login/submitRequestPassword','',$hidden); ?>
            <input type="submit" value="Change password"/>
            <?= form_close(); ?>
            </td>

            <td><?= form_dropdown('is_admin', $options, $row['is_admin']); ?></td>

            <td><?= form_dropdown('is_active', $options, $row['active']); ?></td>
        </tr>
    <?php } ?>
</table>