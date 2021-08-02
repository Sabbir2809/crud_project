<?php
    $conn = mysqli_connect("localhost", "root", "", "student_profile");

    if(isset($_POST['btn'])){
        $stdName = $_POST['stdName'];
        $stdReg = $_POST['stdReg'];

        if(!empty($stdName) && (!empty($stdReg))){
            $query = "INSERT INTO student(stdName, stdReg) VALUE('$stdName', '$stdReg')";
            $createquery = mysqli_query($conn, $query);

            if($createquery){
                echo "Your Data Submitted";
            }
        }
        else{
            echo "Field Should not be Empty!";
        }

    }
?>

<?php
    if(isset($_GET['delete'])){
        $stdId = $_GET['delete'];
        $query = "DELETE FROM student WHERE Id={$stdId}";
        $deletequery = mysqli_query($conn, $query);

        if($deletequery){
            echo "Data Removed successfully";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation Using PHP and MySQL</title>

    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center py-2 bg-dark text-light rounded">CRUD Operation</h1>
    <div class="container shadow m-5 p-3 ">
        <form action="" method="post" class="d-flex justify-content-around">
            <input type="text" class="form-control" name="stdName" placeholder="Enter Your Name">
            <input type="number" class="form-control" name="stdReg" placeholder="Enter Your Reg.">
            <input type="submit" value="send" name="btn" class="btn btn-success">
        </form>
    </div>
    <div class="container shadow m-5 p-3">
        <form action="" method="post" class="d-flex justify-content-around">
            <?php
                if(isset($_GET['update'])){
                    $stdId = $_GET['update'];
                    $query = "SELECT * FROM student WHERE Id={$stdId}";
                    $getdata = mysqli_query($conn, $query);

                    while($rx = mysqli_fetch_assoc($getdata)){
                        $stdId = $rx['Id'];
                        $stdName = $rx['stdName'];
                        $stdReg = $rx['stdReg'];
            ?>
            <input type="text" class="form-control" name="stdName" value="<?php echo $stdName; ?>">
            <input type="text" class="form-control" name="stdReg" value="<?php echo $stdReg; ?>">
            <input type="submit" value="Update" name="update_btn" class="btn btn-primary">

            <?php }} ?>
            <?php
                if(isset($_POST['update_btn'])){
                    $stdName = $_POST['stdName'];
                    $stdReg = $_POST['stdReg'];

                    if(!empty($stdName) && !empty($stdReg)){
                        $query = "UPDATE student SET stdName='$stdName', stdReg=$stdReg WHERE Id=$stdId";
                        $updatequery = mysqli_query($conn, $query);

                        if($updatequery){
                            echo "Data Updated";
                        }
                    }
                    else{
                        echo "Filed Should not be Empty!";
                    }
                }
            ?>
        </form>
    </div>

    <div class="container">
        <table class="table table-bordered text-center shadow">
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Registation Number</th>
                <th></th>
                <th></th>
            </tr>
            <?php
                $query = "SELECT * FROM student";
                $readquery = mysqli_query($conn, $query);
                if($readquery -> num_rows > 0){
                    while($rd = mysqli_fetch_assoc($readquery)){
                        $stdId = $rd['Id'];
                        $stdName = $rd['stdName'];
                        $stdReg = $rd['stdReg'];
                        
            ?>
            <tr>
                <td><?php echo $stdId; ?></td>
                <td><?php echo $stdName; ?></td>
                <td><?php echo $stdReg; ?></td>
                <td><a href="index.php?update=<?php echo $stdId; ?>" class="btn btn-info">Update</a></td>
                <td><a href="index.php?delete=<?php echo $stdId; ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php }} else{
                echo "No Data to Show!";
            } ?>
        </table>
    </div>

    <!-- Javascript CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>