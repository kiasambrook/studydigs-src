<?php
/**
 * Check whether the value is below zero and set the error message.
 *
 * @param Int $item - The value of the item.
 * @param String $itemError - The variable to store error message in.
 * @param String $errorMessage - The name of the item to add to the error message.
 * @return String $itemError - The new error message.
 */
function checkIfBelowZero($item, $itemError, $errorMessage)
{
    if ($item < 0) {
        $itemError = $errorMessage . ' cannot be less than zero';
    }
    return $itemError;
}

/**
 * Check whether the value is empty
 *
 * @param Int $item - The value of the item.
 * @param String $itemError - The variable to store error message in.
 * @param String $errorMessage - The name of the item to add to the error message.
 * @return String $itemError - The new error message.
 */
function checkIfEmpty($item, $itemError, $errorMessage)
{
    if (empty($item)) {
        $itemError = $errorMessage . ' cannot be empty';
    }
    return $itemError;
}

/**
 * Loop through array and check if there are any errors.
 *
 * @param array $array - The array to loop through.
 * @return Bool - If no errors found, return true else return false.
 */
function ensureNoErrors($array)
{
    foreach ($array as $item => $val) {
        if (strpos($item, 'err')) {
            if (!empty($val)) {
                return false;
            }
        }
    }

    return true;
}

/**
 * Check the image file size is below 2MB.
 *
 * @param File $filename - The name of the file
 * @return String - The error message.
 */
function imageFileSize($filename)
{
    $file = $_FILES[$filename];
    if (($file["size"] > 2000000)) {
        return  "Image size exceeds 2MB";
    }

}

/**
 * Check the image file type.
 *
 * @param String $inputName - The name of the file.
 * @param String $errorMessageVar - The error message.
 * @return Strin - The error message if file is wrong format.
 */
function imageExtensionCheck($inputName, $errorMessageVar)
{
    $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
    );

    if ($inputName != "") {
        // Get image file extension
        $file_extension = pathinfo($inputName, PATHINFO_EXTENSION);

        // Validate file input to check if is with valid extension
        if (!in_array($file_extension, $allowed_image_extension)) {
           $errorMessageVar = "Only the formats PNG and JPEG are allowed.";
            return $errorMessageVar;
        }
    }
}

/**
 * Move the file to a permanent location.
 *
 * @param String $file_name - The name of file to store
 * @param String $location - File location to store.
 * @return String - The new path which will be returned.
 */
function moveFiles($file_name, $location)
{
    if (($_FILES[$file_name]['name'] != "")) {
        // download image
        $file = $_FILES[$file_name];
        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        $file_name = md5($file['name']) . '.' . $ext;
        $storedPath = "public/img/" . $location . '/' . $file_name;
        $path =  dirname(APPROOT) . "/public/img/" . $location . "/" . $file_name;
        move_uploaded_file($file['tmp_name'], $path);
        return $storedPath;
    }
}

/**
 * Check whether the postcode is a valid UK postcode.
 * 
 * This code is taken from townscountiespostcodes.co.uk. 
 *
 * @param String $postcode - Postcode to validate.
 * @return boolean - True if correct, and false if incorrect.
 */
function isPostcodeValid($postcode)
{
    //remove all whitespace
    $postcode = preg_replace('/\s/', '', $postcode);

    //make uppercase
    $postcode = strtoupper($postcode);

    if (
        preg_match("/^[A-Z]{1,2}[0-9]{2,3}[A-Z]{2}$/", $postcode)
        || preg_match("/^[A-Z]{1,2}[0-9]{1}[A-Z]{1}[0-9]{1}[A-Z]{2}$/", $postcode)
        || preg_match("/^GIR0[A-Z]{2}$/", $postcode)
    ) {
        return true;
    } else {
        return false;
    }
}