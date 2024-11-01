<?php
// Database connection details
$host = 'sql307.infinityfree.com';
$username = 'if0_37602573';
$password = 'jIV627KQVfo';
$dbname = 'if0_37602573_Student_Database';

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $roll_no = $conn->real_escape_string($_POST['roll_no']);
    $name = $conn->real_escape_string($_POST['name']);
    $regd_no = $conn->real_escape_string($_POST['regd_no']);
    $course = $conn->real_escape_string($_POST['course']);
    $course_duration = $conn->real_escape_string($_POST['course_duration']);
    $date_of_admission = $conn->real_escape_string($_POST['date_of_admission']);
    $student_mobile = $conn->real_escape_string($_POST['student_mobile']);
    $email = $conn->real_escape_string($_POST['email']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $fathers_name = $conn->real_escape_string($_POST['fathers_name']);
    $mothers_name = $conn->real_escape_string($_POST['mothers_name']);
    $fathers_contact = $conn->real_escape_string($_POST['fathers_contact']);
    $mothers_contact = $conn->real_escape_string($_POST['mothers_contact']);
    $address = $conn->real_escape_string($_POST['address']);
    $vill_town = $conn->real_escape_string($_POST['vill_town']);
    $pin_code = $conn->real_escape_string($_POST['pin_code']);
    $district = $conn->real_escape_string($_POST['district']);
    $last_exam_passed = $conn->real_escape_string($_POST['last_exam_passed']);
    $board_university = $conn->real_escape_string($_POST['board_university']);
    $percentage = $conn->real_escape_string($_POST['percentage']);
    $passing_year = $conn->real_escape_string($_POST['passing_year']);
    
    // Handle the uploaded photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];
        $upload_dir = 'uploads/'; // Ensure this directory exists and is writable
        move_uploaded_file($photo_tmp, $upload_dir . $photo);
    } else {
        $photo = null; // Handle the error or set a default value
    }

    // Insert the data into the database
    $sql = "INSERT INTO students (roll_no, name, regd_no, course, course_duration, date_of_admission, student_mobile, email, dob, photo, fathers_name, mothers_name, fathers_contact, mothers_contact, address, vill_town, pin_code, district, last_exam_passed, board_university, percentage, passing_year)
    VALUES ('$roll_no', '$name', '$regd_no', '$course', '$course_duration', '$date_of_admission', '$student_mobile', '$email', '$dob', '$photo', '$fathers_name', '$mothers_name', '$fathers_contact', '$mothers_contact', '$address', '$vill_town', '$pin_code', '$district', '$last_exam_passed', '$board_university', '$percentage', '$passing_year')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>