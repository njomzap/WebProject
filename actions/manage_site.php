<?php

require_once '../classes/manage-site.php';
$site = new ManageSite();

if (isset($_POST['save_changes'])) {
    $footer_text = $_POST['footer_text'] ?? '';
    $show_home = isset($_POST['home']) ? 1 : 0;
    $show_shop = isset($_POST['shop']) ? 1 : 0;
    $show_about = isset($_POST['about']) ? 1 : 0;
    $show_add_post = isset($_POST['add-post']) ? 1 : 0;
    $show_contact = isset($_POST['contact']) ? 1 : 0;

    $slide_headers = [
        '1' => $_POST['slide_1_header'] ?? '',
        '2' => $_POST['slide_2_header'] ?? '',
        '3' => $_POST['slide_3_header'] ?? '',
    ];

    $slideImages = [
        '1' => '',
        '2' => '', 
        '3' => '',
    ];

    foreach ($slideImages as $key => $value) {
        $fileKey = 'slide_' . $key . '_image';
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $site->uploadImage($_FILES[$fileKey], "../images/slides/");
            if (strpos($uploadResult, '/') !== false) {
                $slideImages[$key] = $uploadResult;
            } else {
                echo "Error uploading image for slide $key: $uploadResult";
                exit;
            }
        } else {
            $slideImages[$key] = $site->getExistingImagePath("slide_${key}_image");
        }
    }

    $site->setSiteSettings($footer_text, $show_home, $show_shop, $show_about, $show_add_post, $show_contact, $slide_headers, $slideImages);

    header("Location: ../dashboard.php");
    exit;
}
