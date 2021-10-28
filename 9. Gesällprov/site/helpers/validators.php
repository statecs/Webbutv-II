<?php 

function fieldsAreNotEmpty($data) {
    if(is_array($data)) {
        foreach($data as $key => $value) {
            if($key == 'image') 
                continue;
            else {
                if(empty($value))
                return false;
            }
        }
    }

    return true;
}

function isImage($file) {
    $ext = end(explode(".", $file));
    return in_array($ext, ['png', 'jpeg', 'jpg', 'gif']);
}

function validateSize($file_size, $allowed_size) {
    $file_size = $file_size / 1024 / 1024;
    return $file_size <= $allowed_size;
}

function generateRandomName($file) {
    return str_shuffle('1234567890').$file;
}