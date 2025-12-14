<?php
/**
 * Image Processor
 * Handles image upload, compression, and resizing
 */

class ImageProcessor {
    const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    const MAX_SIZE = 5 * 1024 * 1024; // 5MB
    const THUMBNAIL_WIDTH = 300;
    const THUMBNAIL_HEIGHT = 200;
    const MAX_WIDTH = 1200;
    const MAX_HEIGHT = 800;
    
    /**
     * Process uploaded image
     * @param array $file $_FILES['fieldname']
     * @param string $destination Directory to save
     * @param string $prefix File prefix
     * @return string|false Filename or false on error
     */
    public static function process($file, $destination, $prefix = '') {
        // Validate file
        if (!self::validate($file)) {
            return false;
        }
        
        // Create directory if not exists
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }
        
        // Generate filename
        $filename = self::generateFilename($prefix);
        $filepath = $destination . '/' . $filename;
        
        // Load image
        $image = self::loadImage($file['tmp_name'], $file['type']);
        if (!$image) {
            return false;
        }
        
        // Resize if necessary
        $image = self::resize($image, self::MAX_WIDTH, self::MAX_HEIGHT);
        
        // Save image
        $success = self::saveImage($image, $filepath, $file['type']);
        
        // Create thumbnail
        if ($success) {
            $thumbPath = $destination . '/thumb_' . $filename;
            $thumb = self::resize(
                self::loadImage($filepath, mime_content_type($filepath)),
                self::THUMBNAIL_WIDTH,
                self::THUMBNAIL_HEIGHT
            );
            self::saveImage($thumb, $thumbPath, $file['type']);
        }
        
        return $success ? $filename : false;
    }
    
    /**
     * Validate image file
     */
    private static function validate($file) {
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return false;
        }
        
        if ($file['size'] > self::MAX_SIZE) {
            return false;
        }
        
        $mimeType = mime_content_type($file['tmp_name']);
        if (!in_array($mimeType, self::ALLOWED_TYPES)) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Load image from file
     */
    private static function loadImage($filepath, $mimeType) {
        switch ($mimeType) {
            case 'image/jpeg':
                return imagecreatefromjpeg($filepath);
            case 'image/png':
                return imagecreatefrompng($filepath);
            case 'image/webp':
                return imagecreatefromwebp($filepath);
            case 'image/gif':
                return imagecreatefromgif($filepath);
            default:
                return false;
        }
    }
    
    /**
     * Resize image maintaining aspect ratio
     */
    private static function resize($image, $maxWidth, $maxHeight) {
        $width = imagesx($image);
        $height = imagesy($image);
        
        // Calculate scaling
        $ratio = $width / $height;
        $newWidth = $maxWidth;
        $newHeight = $maxHeight;
        
        if ($ratio > $maxWidth / $maxHeight) {
            $newHeight = (int)($maxWidth / $ratio);
        } else {
            $newWidth = (int)($maxHeight * $ratio);
        }
        
        // Resize only if image is larger
        if ($width <= $newWidth && $height <= $newHeight) {
            return $image;
        }
        
        $resized = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagedestroy($image);
        
        return $resized;
    }
    
    /**
     * Save image to file with compression
     */
    private static function saveImage($image, $filepath, $mimeType) {
        switch ($mimeType) {
            case 'image/jpeg':
                return imagejpeg($image, $filepath, 80); // 80% quality
            case 'image/png':
                return imagepng($image, $filepath, 8);
            case 'image/webp':
                return imagewebp($image, $filepath, 80);
            case 'image/gif':
                return imagegif($image, $filepath);
            default:
                return false;
        }
    }
    
    /**
     * Generate unique filename
     */
    private static function generateFilename($prefix = '') {
        $timestamp = time();
        $random = bin2hex(random_bytes(4));
        $filename = $prefix ? "{$prefix}_{$timestamp}_{$random}.jpg" : "{$timestamp}_{$random}.jpg";
        return sanitizeFilename($filename);
    }
}

/**
 * Sanitize filename
 */
function sanitizeFilename($filename) {
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
    return trim($filename, '._-');
}
