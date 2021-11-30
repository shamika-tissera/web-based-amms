<?php
if(isset($_POST['submit'])){
    $file = $_FILES['image'];

    $fileName = $file['name'];
    $uploadedSuccess = $file['error'];
    $tempName = $file['temp_name'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if($uploadedSuccess === 0){
            if($file['size'] < 5000000){
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '../assets/img/avatars/' . $fileNameNew;
                move_uploaded_file($tempName, $fileDestination);
            }
            else{
                //TODO: ERROR
            }
        }
        else{
            //TODO: ERROR
        }
    }
    else {
        //TODO: ERROR
    }
}