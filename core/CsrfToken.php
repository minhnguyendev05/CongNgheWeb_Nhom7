<?php
/**
 * CSRF Token Manager
 * Generates and validates CSRF tokens for form protection
 */

class CsrfToken {
    const TOKEN_LENGTH = 32;
    const TOKEN_SESSION_KEY = '_csrf_token';
    const TOKEN_FORM_NAME = '_token';
    
    /**
     * Generate and store CSRF token in session
     */
    public static function generate() {
        if (empty($_SESSION[self::TOKEN_SESSION_KEY])) {
            $_SESSION[self::TOKEN_SESSION_KEY] = bin2hex(random_bytes(self::TOKEN_LENGTH));
        }
        return $_SESSION[self::TOKEN_SESSION_KEY];
    }
    
    /**
     * Get current token
     */
    public static function get() {
        return self::generate();
    }
    
    /**
     * Verify token from request
     */
    public static function verify($token = null) {
        if ($token === null) {
            $token = $_POST[self::TOKEN_FORM_NAME] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        }
        
        if ($token === null) {
            return false;
        }
        
        $storedToken = $_SESSION[self::TOKEN_SESSION_KEY] ?? null;
        
        // Timing-safe comparison
        return hash_equals($storedToken ?: '', $token ?: '');
    }
    
    /**
     * Get HTML input field
     */
    public static function field() {
        $token = self::generate();
        return sprintf(
            '<input type="hidden" name="%s" value="%s">',
            self::TOKEN_FORM_NAME,
            htmlspecialchars($token, ENT_QUOTES, 'UTF-8')
        );
    }
}
