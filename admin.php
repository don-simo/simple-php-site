<html>
<head>
<title>Admin Panel</title>
<link rel="stylesheet" type="text/css" href="styleadmin.css">
<style>
    body {   
    background-image: url('<?php echo $bg_image = "bgadmin.jpg"; ?>');
    background-size: cover;
    background-repeat: no-repeat;
    }
    th {
    background-color: lightgrey;
    font-weight: bold;
}
    
  </style>
</head>
<body>
<?php
    $json_data = file_get_contents('data.json');
    $data = json_decode($json_data, true);

    if(isset($_POST['delete_btn'])) {
        if(!empty($_POST['delete'])) {
            foreach($_POST['delete'] as $delete_index) {
                unset($data[$delete_index]);
            }
            $json_data = json_encode($data);
            file_put_contents('data.json', $json_data);
        }
    }

    if(isset($_POST['edit_btn'])) {
        if(!empty($_POST['edit_index']) && !empty($_POST['edit_name']) && !empty($_POST['edit_email']) && !empty($_POST['edit_password'])) {
            $edit_index = $_POST['edit_index'];
            $edit_name = $_POST['edit_name'];
            $edit_email = $_POST['edit_email'];
            $edit_password = $_POST['edit_password'];
            $data[$edit_index] = array('name'=> $edit_name, 'email'=> $edit_email, 'password'=> $edit_password);
            $json_data = json_encode($data);
            file_put_contents('data.json', $json_data);
        }
    }
?>
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Actions</th>
    </tr>
    <?php
    foreach($data as $key => $value) {
    ?>
    <tr>
        <td><?php echo $value['name']; ?></td>
        <td><?php echo $value['email']; ?></td>
        <td><?php echo $value['password']; ?></td>
        <td>
            <form action="admin.php" method="post">
                <input type="checkbox" name="delete[]" value="<?php echo $key; ?>">
                Delete
                <input type="hidden" name="edit_index" value="<?php echo $key; ?>">
                <input type="text" name="edit_name" value="<?php echo $value['name']; ?>">
                <input type="text" name="edit_email" value="<?php echo $value['email']; ?>">
                <input type="text" name="edit_password" value="<?php echo $value['password']; ?>">
                <input type="submit" name="edit_btn" value="Edit">
                <input type="submit" name="delete_btn" value="Delete">
            </form>
        </td>
    </tr>
    <?php
    }
    ?>
</table>

</body>
</html>