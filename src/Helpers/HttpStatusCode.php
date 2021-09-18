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

    /**
     * Client error code
     * 4xx
     */
    const BAD_REQUEST = 400;
    const BAD_REQUEST_REF = 'Bad Request ';

    const UNAUTHORIZED = 401;
    const UNAUTHORIZED_REF = 'Unauthorized';

    const FORBIDDEN = 403;
    const FORBIDDEN_REF = 'Forbidden';

    const NOT_FOUND = 404;
    const NOT_FOUND_REF = 'Not Found';
}
