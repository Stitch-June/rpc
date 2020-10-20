<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace Gaobinzhan\Rpc\Packet;


use Gaobinzhan\Rpc\Contract\PacketInterface;
use Gaobinzhan\Rpc\Error;
use Gaobinzhan\Rpc\Exception\RpcException;
use Gaobinzhan\Rpc\Protocol;
use Gaobinzhan\Rpc\Response;
use function Gaobinzhan\Rpc\json_encode;
use function Gaobinzhan\Rpc\json_decode;

class JsonPacket implements PacketInterface
{
    public const VERSION = '2.0';

    public const DELIMITER = '::';

    protected $openEofCheck = true;

    protected $packageEof = "\r\n\r\n";

    public function encode(Protocol $protocol): string
    {
        $method = $protocol->getInterface() . self::DELIMITER . $protocol->getMethod();
        $data = [
            'jsonrpc' => self::VERSION,
            'method' => $method,
            'params' => $protocol->getParams(),
            'id' => ''
        ];
        $string = json_encode($data, JSON_UNESCAPED_UNICODE);
        return $this->addPackageEof($string);
    }

    public function decode(string $string): Protocol
    {
        $data = json_decode($string, true);
        $method = $data['method'] ?? '';
        $params = $data['params'] ?? [];

        if (empty($method)) {
            throw new RpcException("Method($string) can not be empty!");
        }

        $methodArray = explode(self::DELIMITER, $method);
        if (count($methodArray) < 2) {
            throw new RpcException("Method($method) is bad format!");
        }

        [$interface, $methodName] = $methodArray;

        if (empty($interface) || empty($methodName)) {
            throw new RpcException("Interface($interface) or Method($methodName) can not be empty!");
        }

        return Protocol::create($interface, $methodName, $params);
    }

    public function decodeResponse(string $string): Response
    {
        $data = json_decode($string, true);

        if (array_key_exists('result', $data)) {
            $result = $data['result'];
            return Response::create($result, null);
        }

        $code = $data['error']['code'] ?? 0;
        $message = $data['error']['message'] ?? '';
        $data = $data['error']['data'] ?? null;

        $error = Error::create((int)$code, (string)$message, $data);
        return Response::create(null, $error);
    }

    public function encodeResponse($result, int $code = null, string $message = '', $data = null): string
    {
        $res['jsonrpc'] = self::VERSION;

        if ($code === null) {
            $res['result'] = $result;

            $string = json_encode($res, JSON_UNESCAPED_UNICODE);
            $string = $this->addPackageEof($string);

            return $string;
        }

        $error = [
            'code' => $code,
            'message' => $message,
        ];

        if ($data !== null) {
            $error['data'] = $data;
        }

        $res['error'] = $error;

        $string = json_encode($res, JSON_UNESCAPED_UNICODE);
        $string = $this->addPackageEof($string);

        return $string;
    }

    /**
     * @return bool
     */
    public function isOpenEofCheck(): bool
    {
        return $this->openEofCheck;
    }

    /**
     * @param bool $openEofCheck
     */
    public function setOpenEofCheck(bool $openEofCheck): void
    {
        $this->openEofCheck = $openEofCheck;
    }

    /**
     * @return string
     */
    public function getPackageEof(): string
    {
        return $this->packageEof;
    }

    /**
     * @param string $packageEof
     */
    public function setPackageEof(string $packageEof): void
    {
        $this->packageEof = $packageEof;
    }

    /**
     * @param string $string
     * @return string
     */
    protected function addPackageEof(string $string): string
    {
        return $this->openEofCheck ? ($string . $this->packageEof) : $string;
    }
}