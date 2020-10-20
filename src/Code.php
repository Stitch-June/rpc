<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 * @desc https://www.jsonrpc.org/specification
 */


namespace Gaobinzhan\Rpc;

/**
 * Class Code
 * @package Gaobinzhan\Rpc
 */
class Code
{
    /**
     * Parse error
     */
    public const PARSE_ERROR = -32700;

    /**
     * Invalid Request
     */
    public const INVALID_REQUEST = -32600;

    /**
     * Method not found
     */
    public const METHOD_NOT_FOUND = -32601;

    /**
     * Invalid params
     */
    public const INVALID_PARAMS = -32602;

    /**
     * Internal error
     */
    public const INTERNAL_ERROR = -32603;
}