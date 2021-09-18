<?php
/**
 * @author fawkescreatvies created on 16/09/2021
 * @reference https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
 */

namespace ApiResponse\Formatter\Helpers;

class HttpStatusCode
{
    /**
     * Information code
     * 1xx
     */
    const CONTINUE = 100;
    const CONTINUE_REF = 'Continue';

    const EARLY_HINTS = 103;
    const EARLY_HINTS_REF = 'Early Hints';

    /**
     * Success code
     * 2xx
     */
    const SUCCESS = 200;
    const SUCCESS_REF = 'Ok';

    const CREATED = 201;
    const CREATED_REF = 'Created';

    const ACCEPTED = 202;
    const ACCEPTED_REF = 'Accepted';

    const NON_AUTHORITATIVE_INFORMATION = 203;
    const NON_AUTHORITATIVE_INFORMATION_REF = 'Non-Authoritative Information';

    const NO_CONTENT = 204;
    const NO_CONTENT_REF = 'No Content';

    const RESET_CONTENT = 205;
    const RESET_CONTENT_REF = 'Reset Content';

    const PARTIAL_CONTENT = 206;
    const PARTIAL_CONTENT_REF = 'Partial Content';

    /**
     * Redirects code
     * 3xx
     */
    const MOVED_PERMANENTLY = 301;
    const MOVED_PERMANENTLY_REF = 'Moved Permanently';

    const FOUND = 302;
    const FOUND_REF = 'Found';

    const SEE_OTHER = 303;
    const SEE_OTHER_REF = 'See Other';

    const NOT_MODIFIED = 304;
    const NOT_MODIFIED_REF = 'Not Modified';

    const TEMPORARY_REDIRECT = 307;
    const TEMPORARY_REDIRECT_REF = 'Temporary Redirect';

    const PERMANENT_REDIRECT = 308;
    const PERMANENT_REDIRECT_REF = 'Permanent Redirect';

    /**
     * Client error code
     * 4xx
     */
    const BAD_REQUEST = 400;
    const BAD_REQUEST_REF = 'Bad Request ';

    const UNAUTHORIZED = 401;
    const UNAUTHORIZED_REF = 'Unauthorized';

    const PAYMENT_REQUIRED = 402;
    const PAYMENT_REQUIRED_REF = 'Payment Required';

    const FORBIDDEN = 403;
    const FORBIDDEN_REF = 'Forbidden';

    const NOT_FOUND = 404;
    const NOT_FOUND_REF = 'Not Found';

    const METHOD_NOT_ALLOWED = 405;
    const METHOD_NOT_ALLOWED_REF = 'Method Not Allowed';

    const NOT_ACCEPTABLE = 406;
    const NOT_ACCEPTABLE_REF = 'Not Acceptable';

    const REQUEST_TIMEOUT = 408;
    const REQUEST_TIMEOUT_REF = 'Request Timeout';

    const CONFLICT = 409;
    const CONFLICT_REF = 'Conflict';

    const GONE = 410;
    const GONE_REF = 'Gone';

    const LENGTH_REQUIRED = 411;
    const LENGTH_REQUIRED_REF = 'Length Required';

    const PRECONDITION_FAILED = 412;
    const PRECONDITION_FAILED_REF = 'Precondition Failed';

    const PAYLOAD_TOO_LARGE = 413;
    const PAYLOAD_TOO_LARGE_REF = 'Payload Too Large';

    const URI_TOO_LONG = 414;
    const URI_TOO_LONG_REF = 'URI Too Long';

    const UNSUPPORTED_MEDIA_TYPE = 415;
    const UNSUPPORTED_MEDIA_TYPE_REF = 'Unsupported Media Type';

    const UNPROCESSABLE_ENTITY = 422;
    const UNPROCESSABLE_ENTITY_REF = 'Unprocessable Entity';

    const UPGRADE_REQUIRED = 426;
    const UPGRADE_REQUIRED_REF = 'Upgrade Required';

    const PRECONDITION_REQUIRED = 428;
    const PRECONDITION_REQUIRED_REF = 'Precondition Required';

    const TOO_MANY_REQUESTS = 429;
    const TOO_MANY_REQUESTS_REF = 'Too Many Requests';

    const REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    const REQUEST_HEADER_FIELDS_TOO_LARGE_REF = 'Request Header Fields Too Large';

    /**
     * Server error code
     * 5xx
     */
    const INTERNAL_SERVER_ERROR = 500;
    const INTERNAL_SERVER_ERROR_REF = 'Internal Server Error';
}
