<?php
/**
 * Query Cache Manager
 * Simple file-based caching for database queries
 */

class QueryCache {
    private static $cacheDir = __DIR__ . '/../storage/cache';
    private static $defaultTTL = 3600; // 1 hour
    
    public static function initialize() {
        if (!is_dir(self::$cacheDir)) {
            mkdir(self::$cacheDir, 0755, true);
        }
    }
    
    /**
     * Get cached result
     */
    public static function get($key) {
        $filepath = self::getFilePath($key);
        
        if (!file_exists($filepath)) {
            return null;
        }
        
        $data = file_get_contents($filepath);
        $cached = unserialize($data);
        
        // Check expiry
        if ($cached['expires'] < time()) {
            unlink($filepath);
            return null;
        }
        
        return $cached['data'];
    }
    
    /**
     * Set cache
     */
    public static function set($key, $data, $ttl = null) {
        $ttl = $ttl ?? self::$defaultTTL;
        $cached = [
            'data' => $data,
            'expires' => time() + $ttl,
            'created' => time()
        ];
        
        $filepath = self::getFilePath($key);
        file_put_contents($filepath, serialize($cached), LOCK_EX);
        chmod($filepath, 0644);
    }
    
    /**
     * Delete cache
     */
    public static function delete($key) {
        $filepath = self::getFilePath($key);
        if (file_exists($filepath)) {
            unlink($filepath);
        }
    }
    
    /**
     * Clear all cache
     */
    public static function clear() {
        $files = glob(self::$cacheDir . '/*.cache');
        foreach ($files as $file) {
            unlink($file);
        }
    }
    
    /**
     * Clear cache by pattern
     */
    public static function clearByPattern($pattern) {
        $files = glob(self::$cacheDir . '/*' . $pattern . '*.cache');
        foreach ($files as $file) {
            unlink($file);
        }
    }
    
    /**
     * Remember - Get or set
     */
    public static function remember($key, $callback, $ttl = null) {
        $cached = self::get($key);
        
        if ($cached !== null) {
            return $cached;
        }
        
        $data = $callback();
        self::set($key, $data, $ttl);
        
        return $data;
    }
    
    private static function getFilePath($key) {
        $hash = md5($key);
        return self::$cacheDir . '/' . $hash . '.cache';
    }
}
