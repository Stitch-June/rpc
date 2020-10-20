<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace Gaobinzhan\Rpc;


class Response
{

    protected $result;

    /**
     * @var Error
     */
    protected $error;

    public static function create($result, $error): Response
    {
        $instance = new static();

        $instance->result = $result;
        $instance->error = $error;

        return $instance;
    }

    /**
     * @return Error|null
     */
    public function getError(): ?Error
    {
        return $this->error;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }
}