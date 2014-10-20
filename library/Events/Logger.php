<?php
/**
 * This is developed for ease of programming of the log messages, so to not
 * create an instance whenever we want to leave a log message.
 *
 */
class Events_Logger
{
    /**
     * Zend logger
     * @var Zend_Log
     */
    private static $_loggerInstance = null;

    /**
     * Start the logging system.
     * @param String $file
     * @param int $level
     */
    public static function initialize(Zend_Log $logger)
    {
        $logger->setEventItem('pid', getmypid());
        $logger->setEventItem('memory', memory_get_usage(true));

        self::$_loggerInstance = $logger;
    }

    /**
     * Assign method name and line number.
     * @param string $methodName
     * @param int $lineNumber
     */
    public static function assignMethodInfo($methodName, $lineNumber)
    {
        self::$_loggerInstance->setEventItem('method', $methodName);
        self::$_loggerInstance->setEventItem('line', $lineNumber);
    }

    /**
     * Log on the debug level.
     * @param String $message
     */
    public static function debug($message, $methodName = '', $lineNumber = '')
    {
        self::assignMethodInfo($methodName, $lineNumber);
        self::$_loggerInstance->log($message, Zend_Log::DEBUG);
    }

    /**
     * Log on the info level.
     * @param String $message
     */
    public static function info($message, $methodName = '', $lineNumber = '')
    {
        self::assignMethodInfo($methodName, $lineNumber);
        self::$_loggerInstance->log($message, Zend_Log::INFO);
    }

    /**
     * Log on the ALERT level.
     * @param String $message
     */
    public static function alert($message, $methodName = '', $lineNumber = '')
    {
        self::assignMethodInfo($methodName, $lineNumber);
        self::$_loggerInstance->log($message, Zend_Log::ALERT);
    }

    /**
     * Log on the CRIT level.
     * @param String $message
     */
    public static function crit($message, $methodName = '', $lineNumber = '')
    {
        self::assignMethodInfo($methodName, $lineNumber);
        self::$_loggerInstance->log($message, Zend_Log::CRIT);
    }

    /**
     * Log on the EMERG level.
     * @param String $message
     */
    public static function emerg($message, $methodName = '', $lineNumber = '')
    {
        self::assignMethodInfo($methodName, $lineNumber);
        self::$_loggerInstance->log($message, Zend_Log::EMERG);
    }

    /**
     * Log on the ERR level.
     * @param String $message
     */
    public static function err($message, $methodName = '', $lineNumber = '')
    {
        self::assignMethodInfo($methodName, $lineNumber);
        self::$_loggerInstance->log($message, Zend_Log::ERR);
    }

    /**
     * Log on the NOTICE level.
     * @param String $message
     */
    public static function notice($message, $methodName = '', $lineNumber = '')
    {
        self::assignMethodInfo($methodName, $lineNumber);
        self::$_loggerInstance->log($message, Zend_Log::NOTICE);
    }

    /**
     * Log on the WARN level.
     * @param String $message
     */
    public static function warn($message, $methodName = '', $lineNumber = '')
    {
        self::assignMethodInfo($methodName, $lineNumber);
        self::$_loggerInstance->log($message, Zend_Log::WARN);
    }
}