<?php

$connection = new mysqli('localhost','root','','team');








if(isset($_POST['student_form'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $cell = $_POST['cell'];
    $gender = $_POST['gender'];
    $skill = $_POST['skill'];
    // Handle photo upload
    $photo = '';
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK){
        $photo_name = time() . '_' . basename($_FILES['photo']['name']);
        $target_dir = 'uploads/';
        if(!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
        $target_file = $target_dir . $photo_name;
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)){
            $photo = $target_file;
        }
    }
    $email = $_POST['email'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $guardian = $_POST['guardian'];
    $enrollment = $_POST['enrollment'];

    if(empty($name)){
        $msg = "Name field is required";
    }else if(empty($age)){
        $msg = "Age field is required";
    }else if(empty($email)){
        $msg = "Email field is required";
    }else{
        // Check for duplicate cell
        $check_sql = "SELECT id FROM students WHERE cell = '$cell'";
        $check_result = $connection->query($check_sql);
        if($check_result && $check_result->num_rows > 0){
            $msg = "Cell number already exists. Please use a different cell number.";
        }else{
            $sql = "INSERT INTO students (name, age, location, cell, gender, skill, photo, email, address, dob, guardian, enrollment) VALUES ('$name','$age','$location','$cell','$gender','$skill','$photo','$email','$address','$dob','$guardian','$enrollment');";
            $connection->query($sql);
            $msg = "Created successfully";
        }
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
        font-family: 'Segoe UI', Arial, sans-serif;
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        min-height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .form-box {
        background: #fff;
        padding: 32px 24px;
        max-width: 800px;
        width: 100%;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(44,62,80,0.12);
        margin: 24px;
        transition: box-shadow 0.2s;
    }
    .form-box:hover {
        box-shadow: 0 16px 48px rgba(44,62,80,0.18);
    }
    .form-box h2 {
        text-align: center;
        margin-bottom: 24px;
        color: #2d3e50;
        font-size: 2rem;
        font-weight: 600;
    }
    .form-box label {
        font-weight: 500;
        display: block;
        margin-top: 16px;
        margin-bottom: 6px;
        color: #34495e;
        letter-spacing: 0.02em;
    }
    .form-box input, .form-box select {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 8px;
        border: 1px solid #bfc9d3;
        border-radius: 6px;
        background: #f8fafc;
        font-size: 1rem;
        transition: border-color 0.2s;
        box-sizing: border-box;
    }
    .form-box input:focus, .form-box select:focus {
        border-color: #4CAF50;
        outline: none;
    }
    .form-box button {
        margin-top: 20px;
        width: 100%;
        padding: 12px;
        background: linear-gradient(90deg, #4CAF50 0%, #45a049 100%);
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 6px;
        font-size: 1.1rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(44,62,80,0.08);
        transition: background 0.2s;
    }
    .form-box button:hover {
        background: linear-gradient(90deg, #45a049 0%, #4CAF50 100%);
    }
    .form-box .msg {
        text-align: center;
        margin-bottom: 12px;
        color: #e74c3c;
        font-weight: 500;
    }
    @media (max-width: 600px) {
        .form-box {
            padding: 18px 8px;
            max-width: 98vw;
        }
        .form-box h2 {
            font-size: 1.3rem;
        }
    }
</style>
</head>
<body>

<div class="form-box">
    <a href ="devs.php">Home</a>
    <h2>Student Registration</h2>

    <?php if(isset($msg)): ?>
        <div class="msg"><?php echo $msg; ?></div>
    <?php endif; ?>

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
        <input type="file" name="photo" accept="image/*" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Address</label>
        <input type="text" name="address" required>

        <label>Date of Birth</label>
        <input type="date" name="dob" required>

        <label>Guardian Name</label>
        <input type="text" name="guardian" required>

        <label>Enrollment Date</label>
        <input type="date" name="enrollment" required>

        <button type="submit" name="student_form">Submit</button>

    </form>
</div>

</body>
</html>

