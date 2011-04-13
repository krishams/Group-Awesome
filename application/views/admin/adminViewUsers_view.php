<table class="adminEditUsersTable" border="1">
    <tr>
        <th>Id</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Role</th>
        <th>Is active</th>
        <th>Delete</th>
        <th>Edit</th>
        <th>More</th>
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
        <?= form_close();?>
        </td>

        <td><?= form_dropdown('roleid', $roleOptions, $row['role_id']); ?></td>

        <td><?= form_dropdown('isactive', $activeOptions, $row['active']); ?></td>

        <td>
            <?php
            //makes sure that only a super admin can delete an admin
            if($row['role_id']==1&&$_SESSION['role_id']!=2){
            }
            else{
                $hidden = array('id' => $row['id']);
                echo form_open('admin/deleteUser','', $hidden); ?>
                <input type="submit" value="Delete"/>
            <?= form_close(); }?>
        </td>
        <td>
            <?php
            //makes sure that only a super admin can delete an admin
            if($row['role_id']==1&&$_SESSION['role_id']!=2){
            }
            else{
            $list = array(
                'f_name' => 'firstname',
                'l_name' => 'lastname',
                'email' => 'email',
                'role_id' => 'roleid',
                'is_active' => 'isactive'
            );
            echo form_open('admin/editUser',$list); ?>
            <input type="submit" value="Edit"/>
            <?= form_close(); }?>
        </td>
        <td>
            More
        </td>
    </tr>
    <?php } ?>
</table>