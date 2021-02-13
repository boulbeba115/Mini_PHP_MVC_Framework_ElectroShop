<?php
function decodeImgs($data)
{
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    $arr = explode('/', $type);
    $ext = $arr[count($arr) - 1];
    $name = generateRandomString() . '_' . strtotime("now") . '.' . $ext;

    if (file_put_contents(APPROOT . '/public/assets/ImgProduct/' . $name, $data))
        return $name;
    return false;
}
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function uploadImg($file, $target_dir, $namef)
{
    $fileName = generateRandomString() . '_' . strtotime("now") . '_' . basename($file[$namef]["name"]);
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    // Check file size
    if ($file["$namef"]["size"] > 8000000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    } else {
        if (move_uploaded_file($file[$namef]["tmp_name"], $target_file)) {
            return $fileName;
        } else {
            return false;
        }
    }
}
