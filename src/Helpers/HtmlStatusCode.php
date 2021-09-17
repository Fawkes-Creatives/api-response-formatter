<?php
/**
 * @author fawkescreatvies created on 16/09/2021
 */

namespace ApiResponse\Formatter\Helpers;

class HtmlStatusCode
{
    /**
     * Information code
     */
    const CONTINUE = 100;
    const EARLY_HITS = 103;

    /**
     * Success code
     */
    const SUCCESS = 200;
    const CREATED = 201;
    const ACCEPTED = 202;

    /**
     * Client error code
     */
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;
}
