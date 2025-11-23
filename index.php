<?php

$connection = new mysqli('localhost','root','','team');








if(isset($_POST['student_form'])){
    $name =$_POST['name'];
    $age =$_POST['age'];

    $location =$_POST['location'];
    $cell =$_POST['cell'];

    $gender =$_POST['gender'];
    $skill =$_POST['skill'];
    $photo =$_POST['photo'];

    if(empty($name)){
        $msg = "name fild is required";
    }else if(empty($age)){
         $msg = "age fild is required";
    }else{
        $sql ="INSERT INTO students (name, age, location, cell, gender, skill, photo)
        VALUES('$name','$age','$location','$cell','$gender','$skill','$photo');";
        $connection ->query($sql);

        $msg = "create successfully";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-box {
        background: #fff;
        padding: 25px;
        width: 400px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .form-box h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-box label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    .form-box input, .form-box select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-box button {
        margin-top: 15px;
        width: 100%;
        padding: 10px;
        background: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .form-box button:hover {
        background: #45a049;
    }
</style>
</head>
<body>

<div class="form-box">
    <h2>Student Registration</h2>

    <?php echo $msg ?? ''; ?>

    <form action="" method="POST" enctype="multipart/form-data">

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Age</label>
        <input type="number" name="age" required>

        <label>Location</label>
        <select name="location">
            <option value="Dhaka">Dhaka</option>
            <option value="Mirpur">Mirpur</option>
            <option value="Chittagong">Chittagong</option>
            <option value="Khulna">Khulna</option>
        </select>

        <label>Cell</label>
        <input type="text" name="cell" required>

        <label>Gender</label>
        <select name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            
        </select>

        <label>Skill</label>
        <select name="skill">
            <option value="PHP">PHP</option>
            <option value="JavaScript">JavaScript</option>
            <option value="Laravel">Laravel</option>
            <option value="SQL">SQL</option>
            <option value="Python">Python</option>
        </select>

        <label>Photo</label>
        <input type="text" name="photo" required>

        <button type="submit" name="student_form">Submit</button>

    </form>
</div>

</body>
</html>

