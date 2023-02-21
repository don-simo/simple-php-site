<html>
<head>
    <title> Index </title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
    body {   
    background-image: url('<?php echo $bg_image = "bg.jpg"; ?>');
    background-size: cover;
    background-repeat: no-repeat;
    }
    
  </style>
</head>
<body>
<div class="admin-panel">
    <a href="admin.php"><button style="background-color:black;">Admin Panel</button></a>
</div>
<form style="background-color:lightblue; margin: 100px auto;" action="index.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <br>
    <input style="background-color:black;" type="submit" value="Submit">
</form>
<?php
    if(isset($_POST['name'], $_POST['email'], $_POST['password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(empty($name) || empty($email) || empty($password)) {
            echo "<div class='message error'>All fields are required</div>";
        } else {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<div class='message error'>Invalid email format</div>";
            } else {
                $data = array();
                $data[] = array('name'=> $name, 'email'=> $email, 'password'=> $password);
                $json_data = json_encode($data);
                $existing_data = file_get_contents('data.json');
                $existing_data_arr = json_decode($existing_data, true);
                $existing_data_arr[] = array('name'=> $name, 'email'=> $email, 'password'=> $password);
                $new_json_data = json_encode($existing_data_arr);
                file_put_contents('data.json', $new_json_data);
                echo "<div class='message success'>Data saved successfully</div>";
            }
        }
    }
?>
  <footer style="background: #1a1a1a; height: 100px; text-align:center; position:absolute; bottom:0; width:105%; left: 0px; color:white;font-size:30px;">
    <div class="Copyright">
      <p>Copyright © 2022 | All rights reserved | Devoloped by LAARIG MOHAMED</p>
    </div>
  </footer>
</body>
</html>