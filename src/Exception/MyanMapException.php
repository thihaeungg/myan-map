<?php

namespace ThihaMorph\MyanMap\Exception;

use Exception;

class MyanMapException extends Exception
{
    public function __construct($message = 'Some Exception', $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}

