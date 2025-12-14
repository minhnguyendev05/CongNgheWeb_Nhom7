<?php
/**
 * Global Error Handler
 * Handles exceptions, errors, and provides consistent error responses
 */

class ErrorHandler {
    
    public static function register() {
        set_exception_handler([self::class, 'handleException']);
        set_error_handler([self::class, 'handleError']);
        register_shutdown_function([self::class, 'handleShutdown']);
    }
    
    public static function handleException(Throwable $exception) {
        $code = $exception->getCode() ?: 500;
        $message = $exception->getMessage() ?: 'An unexpected error occurred';
        
        // Log error
        self::logError($exception);
        
        // Display error page
        if (php_sapi_name() === 'cli') {
            echo "Error: $message\n";
            return;
        }
        
        // For AJAX requests
        if (self::isAjaxRequest()) {
            header('Content-Type: application/json');
            http_response_code($code);
            echo json_encode(['error' => $message, 'code' => $code]);
            return;
        }
        
        // For normal requests
        http_response_code($code);
        require_once __DIR__ . '/../views/errors/error.php';
    }
    
    public static function handleError($level, $message, $file, $line) {
        if (error_reporting() === 0) return false;
        
        $exception = new ErrorException($message, 0, $level, $file, $line);
        self::handleException($exception);
        
        return true;
    }
    
    public static function handleShutdown() {
        $error = error_get_last();
        
        if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
            self::handleError($error['type'], $error['message'], $error['file'], $error['line']);
        }
    }
    
    private static function logError(Throwable $exception) {
        $logDir = __DIR__ . '/../logs';
        if (!is_dir($logDir)) mkdir($logDir, 0755, true);
        
        $logFile = $logDir . '/' . date('Y-m-d') . '.log';
        $message = sprintf(
            "[%s] %s: %s in %s:%d\nStack trace:\n%s\n%s\n",
            date('Y-m-d H:i:s'),
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            $exception->getTraceAsString(),
            str_repeat('-', 80)
        );
        
        file_put_contents($logFile, $message, FILE_APPEND);
    }
    
    private static function isAjaxRequest() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
    
    public static function throw($message, $code = 500) {
        throw new Exception($message, $code);
    }
}
