<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace Gaobinzhan\Rpc;


class Protocol
{
    protected $interface = '';

    protected $method = '';

    protected $params = [];

    /**
     * @param string $interface
     * @param string $method
     * @param array $params
     * @return Protocol
     */
    public static function create(string $interface, string $method, array $params): Protocol
    {
        $instance = new static();
        $instance->interface = $interface;
        $instance->method = $method;
        $instance->params = $params;
        return $instance;
    }

    /**
     * @return string
     */
    public function getInterface(): string
    {
        return $this->interface;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}