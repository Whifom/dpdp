<?php

namespace App\Classes\Helpers;

use Throwable;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\{RequestInterface, ResponseInterface};

class LogHelper
{
    public static function exceptionString(Throwable $exception): string
    {
        $exception_code = (string)$exception->getCode();
        $previous_exception = $exception->getPrevious();

        $return = "Exception [" . get_class($exception) . "] [code:$exception_code]: " . $exception->getMessage(
            ) . " In file " . $exception->getFile() .
            " At line " . $exception->getLine() . " Trace: " . $exception->getTraceAsString();

        if (isset($previous_exception)) {
            $return .= " " . PHP_EOL .
                " *************************************************** Previous Exception ***************************************************: "
                . self::exceptionString($previous_exception);
        }

        return $return;
    }

    public static function guzzleRequestExceptionToString(RequestException $exception): string
    {
        $request = $exception->getRequest();

        $request_log_str = self::guzzleRequestToString($request);
        $response_log_str = '';

        if ($exception->hasResponse()) {
            $response = $exception->getResponse();

            $response_log_str = self::guzzleResponseToString($response);
        }

        return $request_log_str . $response_log_str;
    }

    public static function guzzleRequestToString(RequestInterface $request): string
    {
        $request_url = (string)$request->getUri();
        $request_body_raw = (string)$request->getBody();
        $request_headers = var_export($request->getHeaders(), true);

        return "Request URL [$request_url]. Request body: $request_body_raw . Request headers:
         $request_headers";
    }

    public static function guzzleResponseToString(ResponseInterface $response): string
    {
        $response_status_code = $response->getStatusCode();
        $response_body_raw = (string)$response->getBody();
        $response_headers = var_export($response->getHeaders(), true);

        return "Response status code [$response_status_code]. Response body: $response_body_raw .
             Response headers: $response_headers";
    }

    public static function formatModelForLog($model)
    {
        if (is_object($model) and method_exists($model, 'toArray')) {
            return $model->toArray();
        }

        return $model;
    }
}
