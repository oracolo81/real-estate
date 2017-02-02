<?
class AppError {
    public static function handleError($code, $description, $file = null,
        $line = null, $context = null) {
        CakeLog::write('error', "UNHANDLED! - Code: " . $code . ". Description: " . $description. ". File: " . $file .". Line: " . $line . ". Context: " . implode($context));
        return "";
    }
}