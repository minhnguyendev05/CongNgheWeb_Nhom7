<?php
// ValidationHelper.php

class ValidationHelper {
    
    /**
     * Validate email
     */
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    /**
     * Validate password (min 6 characters)
     */
    public static function validatePassword($password) {
        return strlen($password) >= 6;
    }
    
    /**
     * Validate username (alphanumeric, 3-50 chars)
     */
    public static function validateUsername($username) {
        return preg_match('/^[a-zA-Z0-9_]{3,50}$/', $username) === 1;
    }
    
    /**
     * Validate fullname (2-100 chars, allow spaces and common chars)
     */
    public static function validateFullname($fullname) {
        return preg_match('/^[a-zA-Z0-9\s\-\.\']{2,100}$/u', $fullname) === 1;
    }
    
    /**
     * Validate required fields
     */
    public static function validateRequired($data, $fields) {
        $errors = [];
        foreach ($fields as $field) {
            if (!isset($data[$field]) || trim($data[$field]) === '') {
                $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required';
            }
        }
        return $errors;
    }
    
    /**
     * Validate price (numeric, >= 0)
     */
    public static function validatePrice($price) {
        return is_numeric($price) && floatval($price) >= 0;
    }
    
    /**
     * Validate duration (positive integer)
     */
    public static function validateDuration($duration) {
        return is_numeric($duration) && intval($duration) > 0;
    }
    
    /**
     * Validate level (beginner, intermediate, advanced)
     */
    public static function validateLevel($level) {
        $validLevels = ['beginner', 'intermediate', 'advanced'];
        return in_array($level, $validLevels);
    }
    
    /**
     * Sanitize input (trim and basic cleaning)
     */
    public static function sanitize($input) {
        if (is_array($input)) {
            return array_map([self::class, 'sanitize'], $input);
        }
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Validate file upload
     */
    public static function validateFileUpload($file, $allowedMimes, $maxSize) {
        $errors = [];
        
        if (!isset($file) || empty($file['name'])) {
            return ['File is required'];
        }
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'File upload error: ' . $file['error'];
        }
        
        if (isset($file['size']) && $file['size'] > $maxSize) {
            $errors[] = 'File size exceeds ' . ($maxSize / 1024 / 1024) . 'MB limit';
        }
        
        if (!empty($allowedMimes)) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
            
            if (!in_array($mimeType, $allowedMimes)) {
                $errors[] = 'Invalid file type. Allowed: ' . implode(', ', $allowedMimes);
            }
        }
        
        return $errors;
    }
}
