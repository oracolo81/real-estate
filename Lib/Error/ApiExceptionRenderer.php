<?php
class ApiExceptionRenderer extends ExceptionRenderer
{
    public function __construct(Exception $exception)
    {
        parent::__construct($exception);
    }

/**
 * Renders the response for the exception.
 *
 * @return void
 */
    public function render()
    {
        parent::render();
        header("content-type: application/json");
    }
}
