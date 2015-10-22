<?php namespace App\Http\Controllers;

use Request;
use anlutro\cURL\Laravel\cURL;

class ConfigController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	/**
	 * @return Response
	 */
	public function index() {
		$checkNameList = array(
			'chaoguo' => TRUE,
			'hailongchen' => FALSE,
			'yutingwu' => FALSE,
			'yishuliu' => FALSE,
		);

		if (!empty($_GET['check_name'])) {
			$checkName = $_GET['check_name'];
			//set cookie
			setcookie("checked_name", $checkName, time() + 3600);
		}
		elseif (!empty($_COOKIE['checked_name'])) {
			$checkName = $_COOKIE['checked_name'];			
		}

		$snakeList = array();
		$virusList = array();

		if (!empty($checkName)) {
			foreach ($checkNameList as $key => $check) {
				if ($key == $checkName) {
					$checkNameList[$key] = TRUE;
				}
				else {
					$checkNameList[$key] = FALSE;
				}
			}
			$response = cURL::get(self::DEV_HOST . '/2.0/order/xhprof_config_list?name=' . $checkName);
			$body = json_decode($response->body, TRUE);
			$configList = $body['data']['info'];

			foreach ($configList['virus_action'] as $key => $value) {
				foreach ($value as $_key => $_value) {
					$arr = explode(':', $_value);
					$virusList[$key][$_key]['name'] = $arr[0];
					$virusList[$key][$_key]['switch'] = isset($arr[1]) ? $arr[1] : 'off';
				}
			}
			foreach ($configList['snake_action'] as $key => $value) {
				foreach ($value as $_key => $_value) {
					$arr = explode(':', $_value);
					$snakeList[$key][$_key]['name'] = $arr[0];
					$snakeList[$key][$_key]['switch'] = isset($arr[1]) ? $arr[1] : 'off';
				}
			}
		}


		$param = array(
			'current' => '配置',
			'tab' => 'config',
			'name_list' => $checkNameList,
			'virus_config_list' => $virusList,
			'snake_config_list' => $snakeList,
		);
		return view('config', $param);
	}

	/**
	 * 添加配置
	 */
	public function add() {
		$param = array(
			'author' => $_POST['author'],
			'framework' => $_POST['framework'],
			'module' => $_POST['module'],
			'action' => $_POST['action'],
			'switch' => $_POST['switch'],
		);

		$url = self::DEV_HOST . '/2.0/order/xhprof_config_add';
		$response = cURL::post($url, $param);

		return redirect('/config');

	}

	/**
	 * 删除配置 
	 *
	 * @return string
	 */
	public function delete() {

		$param = array(
			'author' => $_POST['name'],
			'module' => $_POST['module'],
			'action' => $_POST['action'],
			'framework' => $_POST['framework'],
			'switch' => $_POST['swi'],
		);


		$url = self::DEV_HOST . '/2.0/order/xhprof_config_delete';
		$response = cURL::post($url, $param);

	}

}
