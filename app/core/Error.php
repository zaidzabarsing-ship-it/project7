<?php

namespace App\Core;

class Error extends Controller
{
	public function fileNotFound()
	{
		http_response_code(404);
		$this->guest('error/404');
	}
}
