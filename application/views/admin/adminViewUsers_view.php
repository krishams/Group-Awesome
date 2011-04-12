<table border="1">
    <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Password</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Is admin</th>
        <th>Active</th>
    </tr>

    <?php foreach ($users as $row) {
    ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['email']; ?></td>
            <td>
                <form_open
                <input type="submit" value="Change password"/>
            </td>
            <td><?= $row['f_name']; ?></td>
            <td><?= $row['l_name']; ?></td>
            <td><?= $row['is_admin']; ?></td>
            <td><?= $row['active']; ?></td>
        </tr>
    <?php } ?>
</table>