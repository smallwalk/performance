<?php namespace App\Http\Controllers;

use Request;
use anlutro\cURL\Laravel\cURL;

class WelcomeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest');
	}

    public function index() {
        
    }

	/**
	 * Xhprof Performance Analysis(virus)
	 *
	 * @return Response
	 */
	public function xhprof_list() {
	    $response = cURL::get(parent::DEV_HOST . '/2.0/order/xhprof_list');
	    $xhprofData = json_decode($response->body, 1);
        $data = array();
        if (!empty($xhprofData['data'])) {
            foreach ($xhprofData['data'] as $info) {
                $url = parse_url($info['host']);
                $info['host'] = $url['host'];
                $info['path'] = !empty($url['path']) ? $url['path'] : '';
                $info['query'] = !empty($url['query']) ? $url['query'] : '';
                $info['xhprof_detail_url'] = parent::XHPROF_HOST . '/?run=' . $info['key'];
                $data[$info['key']] = $info;
            }
        }
	    return view('xhprof', ['xhprofData' => $data, 'current' => 'Xhprof Analysis', 'tab' => 'virus']); 
	}

    public function xhprof_detail($id) {
        $response = cURL::get(parent::DEV_HOST . '/2.0/order/xhprof_detail_diy?uniqid=' . $id);    
	    $xhprofData = json_decode($response->body, 1);
        return $xhprofData;
    }
}
