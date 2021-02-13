<?php
function toJson($data, $path)
{
    $jsonData = [];
    if (!file_exists(APPROOT . '/app/data/' . $path)) {
        $jsonData = json_encode([$data]);
    } else {
        /*$inp = file_get_contents(APPROOT . '/app/data/' . $path);
        $tempArray = json_decode($inp);
        $json = json_encode($data);
        //append additional json to json file
        //open or read json data*/
        $data_results = file_get_contents(APPROOT . '/app/data/' . $path);
        $tempArray = json_decode($data_results);
        $tempArray[] = $data;
        $jsonData = json_encode($tempArray);
    }

    if (file_put_contents(APPROOT . '/app/data/' . $path, $jsonData))
        return true;
    else
        return false;
}
function JsonToData($file)
{
    $path = '../app/data/' . $file;
    if (file_exists($path)) {
        try {
            $fileContent = file_get_contents($path);
            $data = json_decode($fileContent);
            return $data;
        } catch (Exception $e) {
            return false;
        }
    }
    return false;
}
