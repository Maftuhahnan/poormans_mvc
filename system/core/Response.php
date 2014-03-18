<?php

namespace Core;

class Response
{
	public static function redirect($to, $statusCode=302)
    {
        header('Location: '.Request::base_url().'/'.$to, true, $statusCode);
        exit();
    }
}