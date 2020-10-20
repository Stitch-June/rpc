<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace Gaobinzhan\Rpc;


class Error
{
    /**
     * @var int
     */
    protected $code = 0;

    /**
     * @var string
     */
    protected $message = '';

    /**
     * @var mixed
     */
    protected $data;

    public static function create(int $code, string $message, $data): Error
    {
        $instance = new static();
        $instance->code = $code;
        $instance->message = $message;
        $instance->data = $data;
        return $instance;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

}