<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	const DEV_HOST = 'doota.chaoguo.rdlab.meilishuo.com';
	const XHPROF_HOST = 'http://xhprof.chaoguo.rdlab.meilishuo.com';
}
