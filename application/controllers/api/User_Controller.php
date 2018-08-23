<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class User_Controller extends \Restserver\Libraries\REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("User_Model");
    }

    public function index() {
        echo "xx";
    }

    public function test_post() {

        $id = $this->post("id");

        $this->response($id, 200);
    }

    public function _validate_login($username, $password) {
        if ($username == "" || $username == null) {
            $result = array(
                "status" => "username"
            );

            $this->response($result, 200);
            return 0;
            // exit();
        }

        if ($password == "" || $password == null) {
            $result = array(
                "status" => "password"
            );

            $this->response($result, 200);
            return 0;
            // exit();
        }
        return 1;
    }

    public function Login_check_post() {
        header('Content-Type: application/json');

        $username = $this->post("username");
        $password = $this->post("password");


        $a = $this->_validate_login($username, $password);

        if ($a == 1) {
            $array = array(
                "username" => $username,
                "password" => $password
            );

            $result = $this->User_Model->login_check($array);

            $this->response($result, 200);
        }
        //exit();
    }

    public function get_device_by_id_post() {
        header('Content-Type: application/json');
        $dept_code = $this->post("dept_code");
        $result = $this->Parts_Model->Get_device_by_id($dept_code);

        if ($result['status'] == true) {
            $this->response($result, 200);
        } else {
            $this->response($result, 200);
        }
    }

 

        public function check_rmms_session_post(){
        
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        date_default_timezone_set('Asia/Bangkok');
        header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        header('Content-Type: application/json; charset=utf-8');
        /* Sample GET Data From Service */
        $x = $this->post("x");
        $service = curl_init();
// $_url_service="http://127.0.0.1:8080/rmms/server/service.php?mode=";
        $_url_service = "http://172.17.8.144/rmms/server/service.php?mode=";

        /* ตรวจสอบการ Login ค่า x  */
        $mode = "checker_key";
        $_url = $_url_service . $mode . "&x=" . $x;
        curl_setopt($service, CURLOPT_URL, $_url);
        curl_setopt($service, CURLOPT_RETURNTRANSFER, 1);
        $profile = curl_exec($service);
        //print_r($profile . "\n");
        $_d = json_decode($profile);
        //print_r($_d);
        echo json_encode($_d);
    }

}
