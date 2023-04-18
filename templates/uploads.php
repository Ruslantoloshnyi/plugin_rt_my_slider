<?php

if (isset($_POST['submit'])) {

    // Set the directory where the uploaded file will be stored
    $target_dir = plugin_dir_path(__FILE__) . "uploads/";
    // if (!file_exists($target_dir)) {
    //     mkdir($target_dir, 0777, true);
    // }

    // Get the full path to the uploaded file
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Set the default value for $uploadOk to 1
    $uploadOk = 1;

    // Get the file extension of the uploaded file
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the "submit" button was clicked
    if (isset($_POST["submit"])) {

        // Check if the uploaded file is an image
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image";
            $uploadOk = 0;
        }
    };

    // Check if the size of the uploaded file is greater than 900000 bytes
    if ($_FILES["file"]["size"] > 900000) {
        echo "File is very big";
        $uploadOk = 0;
    };

    // Check if the file type of the uploaded file is supported
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Only JPG, JPEG, PNG and GIF files are allowed.";
        $uploadOk = 0;
    };

    // Check if the "submit" button was clicked
    if (isset($_POST['submit'])) {

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "File does not uploads";
        } else {

            // If there were no errors, attempt to move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "File " . htmlspecialchars(basename($_FILES["file"]["name"])) . " is uploaded!";
            } else {
                echo "An error occurred while uploading the file.";
            }
        }
    };
};
