<!DOCTYPE html>

<?php
$con=mysqli_connect("localhost","root","","php") or die("Connection was not established");
//http://localhost/phpmyadmin/
?>
<html>
    <head>
        <title>PHP & MySQL</title>
    </head>
<body>
    <form method="post" action="form.php">
        <input type="text" name="name" placeholder="Write your name"/><br/>
        <input type="password" name="pass" placeholder="Write your passwors"/><br/>
        <input type="text" name="email" placeholder="Write your email"/><br/>
        <input type="submit" name="sub" value="Insert Data"/>
    </form>
    
    <?php
    if(isset($_POST['sub'])){
        $name=$_POST['name'];
        $pass=$_POST['pass'];
        $email=$_POST['email'];
        $insert = "insert into users (name,pass,email) values ('$name','$pass','$email')";
        
        $run=mysqli_query($con,$insert);
        if($run){
            echo "<h3>Registration Successful, Thanks!</h3>";
        }
    }
    ?>
    <br/>
    <table width="500" bgcolor="pink" border="2">
        <tr>
            <th>S.N</th>
            <th>Name</th>
            <th>Password</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        
        <?php
			//select user_name from users where id='thisid',.RAND()
			$select = "select * from users order by 1 LIMIT 0,25";
            
			$run = mysqli_query($con,$select); 
			
			$i = 0;
			while($row=mysqli_fetch_array($run)){
			$user_id = $row['id'];
			$user_name = $row['name']; 
			$user_pass = $row['pass']; 
			$user_email = $row['email'];
			$i++;
		?>
		<tr align="center">
			<td><?php echo $i;?></td>
			<td><?php echo $user_name;?></td>
			<td><?php echo $user_pass;?></td>
			<td><?php echo $user_email;?></td>
			<td><a href="form.php?edit=<?php echo $user_id; ?>">Edit</a></td>
			<td><a href="form.php?delete=<?php echo $user_id; ?>">Delete</a></td>
		</tr>
		<?php } ?>
    </table>
    
    <?php
        if(isset($_GET['edit'])){
            include("edit.php");
        }    
    ?>
    
    <?php
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
        $delete="delete from users where id='$delete_id'";
        $run_delete=mysqli_query($con,$delete);
            if($run_delete){
                echo "<script>alert('A user has been deleted!')</script>";
                echo "<script>Window.open('form.php','_self')</script>";
            }
    }
    
    
    ?>
</body>
</html>












