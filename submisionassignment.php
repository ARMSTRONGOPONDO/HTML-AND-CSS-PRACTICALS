<?php
// Retrieve POST data from the form submission
$UNITCODE = $_POST['UNITCODE'];
$UNITNAME = $_POST['UNITNAME'];
$ASSIGNMENT_FILE = $_FILES['ASSIGNMENT_FILE'];

// Create a new MySQLi connection to the database
$con = new mysqli("localhost", "root", "", "ASSIGNMENTS");

// Check if the connection to the database was successful
if ($con->connect_error) {
    // If the connection failed, stop the script and print the error
    die("Connection failed: " . $con->connect_error);
}

// Handle the file upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($ASSIGNMENT_FILE["name"]);
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$uploadOk = 1;

// Check if file is a valid Word or PDF document
if ($fileType != "doc" && $fileType != "docx" && $fileType != "pdf") {
    echo "Sorry, only DOC, DOCX, and PDF files are allowed.";
    $uploadOk = 0;
}

// Check file size
if ($ASSIGNMENT_FILE["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file and insert record into database
} else {
    if (move_uploaded_file($ASSIGNMENT_FILE["tmp_name"], $target_file)) {
        // File uploaded successfully, now insert record into database
        $file_path = $target_file;

        // Prepare the SQL query to insert the data into the ASSIGNMENTS table
        $sql = "INSERT INTO assighntable (UNITCODE, UNITNAME, ASSIGNMENT_FILE) VALUES ('$UNITCODE', '$UNITNAME', '$file_path')";

        // Execute the SQL query
        if ($con->query($sql) === TRUE) {
            // If the query was successful, output a JavaScript alert and redirect to 4uploadfile.php
            echo "<script>
                    alert('Assignment successfully submitted');
                    window.location.href = assignment_submision.php;
                  </script>";
        } else {
            // If there was an error with the query, print the error
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Close the database connection
$con->close();
?>