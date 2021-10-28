<?php 

function formFieldsToSession($data) {
    if(is_array($data)) {
        foreach($data as $key => $value) {
            if(!empty($value))
                $_SESSION[$key] = $value;
        }
    }
}

function deleteFormFieldsFromSession($data) {
    if(isset($_SESSION) && count($_SESSION) > 0) {
        foreach($data as $key => $value) {
            unset($_SESSION[$key]);
        }
    }
}