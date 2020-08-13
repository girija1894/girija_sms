<?php
        session_start();
        include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style type="text/css">
          #header{
            height:10%;
            width:100%;
            top:2%;
            background-color:black;
            position:fixed;
            color:white;
        }
        #stud{
            width:100%;
           /* left:17%;*/
            top:50%;
            color:red;
            margin-top:10%;
        }
    </style>
</head>
<body>
    <div id="header">
        <center><strong><br>Student Management System &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>Email:<?php echo $_SESSION['email']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name:<?php echo $_SESSION['name']; ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="logout.php">logout</a>
        </center>
    </div>
    <?php if(!isset($_GET['action'])){ ?>
    <div id="stud">
    <table  class="table table-bordered">
        <tr>
            <th>Email</th>
            <th>Password</th>
            <th>Name</th>
            <th>College</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Degree</th>
            <th colspan="2">Action</th>
        </tr>
       
        <?php
          $result = mysqli_query($conn, "select * from student where id='$_SESSION[id]'"); 
            while($row = mysqli_fetch_array($result)){  ?>
                    <tr>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['college']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['degree']; ?></td>
                        <td> <a href="student_dashboard.php?sID=<?php echo $row['id']; ?>&action=edit">EDIT</a>   </td>
                    </tr>
            <?php } ?>
    </table>
    </div>
            <?php  } ?>
    <?php
         $id="";
         $email="";
         $password="";
         $name="";
         $college="";
         $phone="";
         $address="";
         $degree="";
         $student_data ='';
         if(isset($_GET['edit'])){
            $id=$_GET['edit'];
            //echo $id;
            $edit_state=true;
            $rec=mysqli_query($conn, "select * from student where id=$id");
            $record=mysqli_fetch_array($rec);
            $id=$record['id'];
            $email=$record['email'];
            $password=$record['password'];
            $name=$record['name'];
            $college=$record['college'];
            $phone=$record['phone'];
            $address=$record['address'];
            $degree=$record['degree'];
        }

        
        if(isset($_POST['update'])){ //echo '<pre/>'; print_r($_POST);exit;
            $id=$_POST['id'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $name=$_POST['name'];
            $college=$_POST['college'];
            $phone=$_POST['phone'];
            $address=$_POST['address'];
            $degree=$_POST['degree'];
           
    
            mysqli_query($conn, "update student set email='$email', password='$password',name='$name', college='$college',phone='$phone', address='$address', degree='$degree' where id='$id'");
            //echo "update student set email='$email', password='$password',name='$name', college='$college',phone='$phone', address='$address', degree='$degree' where id='$id'";exit;
            header('location:student_dashboard.php');
        }

    ?>
<?php if(isset($_GET['action']) && $_GET['action'] == 'edit'){ 
   echo $sID = (isset($_GET['sID']) && $_GET['sID'] != '')?$_GET['sID']:'';
   $student_query = mysqli_query($conn, "select * from student where id= '".$sID."'");
   //echo "select * from student where id= '".$sID."'";
   $student_data = mysqli_fetch_array($student_query);  //print_r($student_data);
    ?>
    <br><br><br><br><br>
<form method="post">
            <input type="hidden" name="id" value="<?php echo $student_data['id']; ?>">
             Email : <input type="text" name="email" id="email" value="<?php echo $student_data['email']; ?>"><br><br>
             Password  : <input type="text" name="password" id="password" value="<?php echo $student_data['password']; ?>"><br><br>
             Name : <input type="text" name="name" id="name" value="<?php echo $student_data['name']; ?>"><br><br>
             College  : <input type="text" name="college" id="college" value="<?php echo $student_data['college']; ?>"><br><br>
             Phone : <input type="text" name="phone" id="phone" value="<?php echo $student_data['phone']; ?>"><br><br>
             Address  : <input type="text" name="address" id="address" value="<?php echo $student_data['address']; ?>"><br><br>
             Degree : <input type="text" name="degree" id="degree" value="<?php echo $student_data['degree']; ?>"><br><br>
      
            <input type="submit" name="update" value="update">
       
    </form><br>
    <?php } ?>   
</body>
</html>