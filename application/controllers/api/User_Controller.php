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

}
