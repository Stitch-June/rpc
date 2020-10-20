<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace Gaobinzhan\Rpc\Contract;

use Gaobinzhan\Rpc\Protocol;
use Gaobinzhan\Rpc\Response;

/**
 * Interface PacketInterface
 * @package Gaobinzhan\Rpc
 */
interface PacketInterface
{
    public function encode(Protocol $protocol): string;

    public function decode(string $string): Protocol;

    public function encodeResponse($result, int $code = null, string $message = '', $data = null): string;

    public function decodeResponse(string $string): Response;
}