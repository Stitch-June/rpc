<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace Gaobinzhan\Rpc;


function json_encode($value, int $options = 0, int $depth = 512)
{

    $json = \json_encode($value, $options, $depth);

    if (JSON_ERROR_NONE !== json_last_error()) {
        throw new \InvalidArgumentException('json_encode error: ' . json_last_error_msg());
    }

    return $json;
}

function json_decode(string $json, bool $assoc = false, int $depth = 512, int $options = 0)
{
    $data = \json_decode($json, $assoc, $depth, $options);

    if (JSON_ERROR_NONE !== json_last_error()) {
        throw new \InvalidArgumentException('json_decode error: ' . json_last_error_msg());
    }

    return $data;
}


