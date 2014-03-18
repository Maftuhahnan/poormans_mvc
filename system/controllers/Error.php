<?php

namespace Controller;

use Core\Controller;

class Error extends Controller
{
	public function handle($options)
    {
        echo "<h3>{$options}</h3>";
    }
}