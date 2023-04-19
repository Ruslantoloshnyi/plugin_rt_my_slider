<?php

if (isset($_POST['submit'])) {

    // Set the directory where the uploaded file will be stored
    $target_dir = RT_SLIDER__PLUGIN_DIR . "uploads/";

    // Get the full path to the uploaded file
    $target_file = $target_dir . uniqid() . basename($_FILES["file"]["name"]);

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
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                global $wpdb;

                $date = date('Y-m-d');
                $table_name = $wpdb->prefix . 'rt_slider_tbl';

                $wpdb->insert(
                    $table_name,
                    [
                        'image_name' => basename($_FILES["file"]["name"]),
                        'path'       => $target_file,
                        'date'       => $date
                    ],
                    [
                        '%s',
                        '%s',
                        '%s'
                    ]
                );

                echo "File " . htmlspecialchars(basename($_FILES["file"]["name"])) . " is uploaded!";
            } else {
                echo "An error occurred while uploading the file.";
            }
        }
    };
};
