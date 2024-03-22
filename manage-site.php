<?php

require_once __DIR__ . '/../includes/dbh.inc.php';

class ManageSite extends dbConnect {
    protected $dbconn;

    public function __construct() {
        $this->dbconn = $this->connect();
    }

    public function setSiteSettings($footer_text, $show_home, $show_shop, $show_about, $show_add_post, $show_contact, $slide_headers, $slide_images) {
        $checkSql = 'SELECT COUNT(*) FROM manage_site';
        $checkStmt = $this->dbconn->prepare($checkSql);
        $checkStmt->execute();
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            $sql = "UPDATE manage_site SET footer_text = ?, show_home = ?, show_shop = ?, show_about = ?, show_add_post = ?, show_contact = ?, slide_1_header = ?, slide_1_image = ?, slide_2_header = ?, slide_2_image = ?, slide_3_header = ?, slide_3_image = ?";
        } else {
            $sql = "INSERT INTO manage_site (footer_text, show_home, show_shop, show_about, show_add_post, show_contact, slide_1_header, slide_1_image, slide_2_header, slide_2_image, slide_3_header, slide_3_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        }

        $params = [
            $footer_text, $show_home, $show_shop, $show_about, $show_add_post, $show_contact,
            $slide_headers['1'], $slide_images['1'],
            $slide_headers['2'], $slide_images['2'],
            $slide_headers['3'], $slide_images['3']
        ];

        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute($params);
    }

    public function uploadImage($file, $targetDir) {
        $baseName = basename($file["name"]);
        $sanitizedFileName = preg_replace("/[^a-zA-Z0-9.]/", "_", $baseName);
        $targetFilePath = $targetDir . $sanitizedFileName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        $check = getimagesize($file["tmp_name"]);
        if($check === false) {
            return "File is not an image.";
        }

        if (file_exists($targetFilePath)) {
            return "Sorry, file already exists.";
        }

        if ($file["size"] > 5000000) {
            return "Sorry, your file is too large.";
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }

        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            return $targetFilePath;
        } else {
            return "Sorry, there was an error uploading your file.";
        }
    }

    public function getExistingImagePath($imageName) {
        $sql = "SELECT $imageName FROM manage_site LIMIT 1";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result[$imageName] ?? '';
    }

    public function getSiteSettings() {
        $sql = 'SELECT * FROM manage_site LIMIT 1';
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }
}
