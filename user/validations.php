<?php
function isValidDate($date) {
    // Check if the date is empty
    if (empty($date)) {
        return false; // Date is blank
    }

    // Check if the date is a valid format
    if (strtotime($date) === false) {
        return false; // Invalid date format
    }
    return true; // Date is valid
}


function IsValidHour($number) {
    // Remove any non-digit and non-decimal characters from the number
    $number = preg_replace('/[^0-9.]/', '', $number);

    // Check if the number is not empty and is numeric
    if ($number >= 0 && !empty($number) && is_numeric($number)) {
        $number = (float)$number; // Convert the number to float for decimal comparison

        if ($number >= 0.25 && $number <= 15.00) {
            return true; // Number is between 0.25 and 15.00 (inclusive)
        } else {
            return false; // Number is not between 0.25 and 15.00 or negative
        }
    } else {
        return false; // Invalid number
    }
}


//Option field validate
function IsOptionSelect($option) {
	if (!empty($option)) {
		return true;
	} else {
		return false;
	}
}

function validateUsername($username) {
    // Username validation rules
    // You can modify these rules based on your requirements
    $minLength = 3;
    $maxLength = 15;

    if (empty($username)) {
        return "Username is required.";
    } elseif (strlen($username) < $minLength || strlen($username) > $maxLength) {
        return "Username must be between $minLength and $maxLength characters.";
    } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        return "Username can only contain letters, numbers, and underscores.";
    }

    return null; // Validation passed
}

function validatePassword($password) {
    // Password validation rules
    // You can modify these rules based on your requirements
    $minLength = 3;
    $maxLength = 20;
    // || strlen($password) > $maxLength
    if (empty($password)) {
        return "Password is required.";
    } 
    // else if (strlen($password) <= $minLength) {
    //     return "Password must be between $minLength and $maxLength characters.";
    // }

    return null; // Validation passed
}


?>