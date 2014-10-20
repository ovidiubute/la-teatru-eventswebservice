<?php
/**
 * Formater for the log of the applications.
 * This is being used by the Zend_Log instance.
 *
 */
class Events_Logger_Writer extends Zend_Log_Writer_Stream
{
    /**
     * Detailed log format: with method anme and line number.
     * @var string
     */
    const LOG_FORMAT_DETAILED = '%timestamp% | %pid% | %memory% | %priorityName% | %method% | %line% | %message%';

    /**
     * Default log format.
     * @var string
     */
    const LOG_FORMAT = '%timestamp% | %pid% | %memory% | %priorityName% | %message%';

    /**
     * Override
     *
     * @param  streamOrUrl     Stream or URL to open as a stream
     * @param  mode            Mode, only applicable if a URL is given
     */
    public function __construct($streamOrUrl, $mode = NULL)
    {
        parent::__construct($streamOrUrl, $mode);

        $formatter = new Zend_Log_Formatter_Simple(self::LOG_FORMAT . PHP_EOL);

        $this->setFormatter($formatter);
    }

    /**
     * Create a new instance of this writer.
     *
     * @param  array|Zend_Config $config
     * @return Zend_Log_Writer_Mock
     * @throws Zend_Log_Exception
     */
    public static function factory($config)
    {
        $config = self::_parseConfig($config);
        $config = array_merge(array(
            'stream' => null,
            'mode'   => null,
        ), $config);

        $streamOrUrl = isset($config['url']) ? $config['url'] : $config['stream'];

        return new Events_Logger_Writer(
            $streamOrUrl,
            $config['mode']
        );
    }
}