<?php 

function createSlug($string) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    return $slug;
}

function trimText($string, $limit) {
    if (strlen($string) > $limit) {
        // Trim the string to the specified length and append an ellipsis
        return substr($string, 0, $limit) . "...";
    } else {
        // If the string is shorter than the limit, return it as is
        return $string;
    }
}
