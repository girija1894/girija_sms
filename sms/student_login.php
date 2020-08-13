<?php include 'conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<center><br><br>
        <h3>Student Login Page</h3>
        <form method="post">
           Email:    <input type="text" name="email" required><br><br>
           Password: <input type="password" name="password" required><br><br> 
            <input type="submit" name="submit">
        </form>
        <?php
        session_start();
            if(isset($_POST['submit'])){
                $query="select * from student where email = '$_POST[email]'";
                $run_query=mysqli_query($conn,$query);
                while($row=mysqli_fetch_assoc($run_query)){
                    if($row['email'] == $_POST['email']){
                        if($row['password'] == $_POST['password']){
                            $_SESSION['id']=$row['id'];
                            $_SESSION['email']=$row['email'];
                            $_SESSION['name']=$row['name'];
                            header("location:student_dashboard.php");
                        }
                        else{
                            echo "Wrong Pasword";
                        }
                    }
                   
                }
            }
        ?>
    </center>
</body>
</html>