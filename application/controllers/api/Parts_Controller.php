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
class Parts_Controller extends \Restserver\Libraries\REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("Parts_Model");
    }

    public function index() {
        echo "index";
    }

    public function test_post() {

        $id = $this->post("id");

        $this->response($id, 200);
    }

    public function test_line_post() {

        $id = $this->post("id");
        $method = $this->post("method");

        $array = "นาย $id ทำการลา $method";

        $this->response($array, 200);
    }

    public function line_notify_post() {
        header("Content-Type:text/xml");
        $Token = "3RwkmE9TryLRO0BpWjAthQo5FEzDevaP47NhYg4b0PJ";
        
        $postData = file_get_contents("php://input");
        $xml = simplexml_load_string($postData);
        $id = $this->input->post('actCode');
        $user = $this->input->post('user');
//        foreach ($id as $key => $value) {
//            $data.= $this->input->post($key)."//";
//        }
        $user = $this->input->post('user');
        $message = "แจ้งเตือน ทดสอบ $postData $xml";
        $lineapi = $Token; // ใส่ token key ที่ได้มา
        $mms = trim($message); // ข้อความที่ต้องการส่ง
        date_default_timezone_set("Asia/Bangkok");
        $chOne = curl_init();
        curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        // SSL USE 
        curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
        //POST 
        curl_setopt($chOne, CURLOPT_POST, 1);
        curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=$mms");
        curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
        $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $lineapi . '',);
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($chOne);
        //Check error 
//        if (curl_error($chOne)) {
//            echo 'error:' . curl_error($chOne);
//        } else {
//            $result_ = json_decode($result, true);
//            echo "status : " . $result_['status'];
//            echo "message : " . $result_['message'];
//        }

        curl_close($chOne);
        $this->response($postData, 200);
    }

    public function get_all_department_get() {
        header('Content-Type: application/json');
        $result = $this->Parts_Model->Get_all_department();
        $this->response($result, 200);
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

    public function paytran_list_get() {
        header('Content-Type: application/json');
        $result = $this->Parts_Model->Get_paytran_list();

        $this->response($result, 200);
    }

    public function paytran_by_id_post() {
        header('Content-Type: application/json');

        $BILLNO = $this->post("BILLNO");

        $result = $this->Parts_Model->Get_paytran_by_id($BILLNO);

        $this->response($result, 200);
    }

    public function search_paytran_post() {
        header('Content-Type: application/json');

        $NO_REC = $this->post("NO_REC");

        $result = $this->Parts_Model->search_paytran($NO_REC);
        $this->response($result, 200);
    }

    public function paydetail_by_id_post() {
        header('Content-Type: application/json');
        $id = $this->post("BILLNO");

        $result = $this->Parts_Model->Get_paydetail_by_id($id);

        $this->response($result, 200);
    }

    public function insert_rcvtran_post() {
        header('Content-Type: application/json');
        $NO_REC = $this->post("NO_REC");
        $BILLNO = $this->post("BILLNO");
        $DETAIL = $this->post("DETAIL");
        $MT_CODE = $this->post("MT_CODE");
        $result = $this->Parts_Model->Insert_rcvtran($NO_REC, $BILLNO, $MT_CODE, $DETAIL);

//        $result = $BILLNO[0]."||".$DETAIL[0];

        $this->response($result, 200);
    }

    public function rcvtran_list_get() {
        header('Content-Type: application/json');
        $result = $this->Parts_Model->rcvtran_list();

        $this->response($result, 200);
    }

    public function rcvtran_by_id_post() {
        header('Content-Type: application/json');
        $id = $this->post("BILLNO");
        $result = $this->Parts_Model->rcvtran_by_id($id);

        $this->response($result, 200);
    }

    public function rcvdetail_by_id_post() {
        header('Content-Type: application/json');
        $BILLNO = $this->input->post("BILLNO");

        $result = $this->Parts_Model->rcvdetail_by_id($BILLNO);

        $this->response($result, 200);
    }

    public function rcvdetail_list_get() {
        header('Content-Type: application/json');

        $result = $this->Parts_Model->rcvdetail_list();

        $this->response($result, 200);
    }

    public function rcvtran_cancel_post() {
        header('Content-Type: application/json');
        $BILLNO = $this->input->post("BILLNO");

        $result = $this->Parts_Model->rcvtran_cancel($BILLNO);

        $this->response($result, 200);
    }

    public function rcv_cancel_post() {
        header('Content-Type: application/json');
        $BILLNO = $this->input->post("BILLNO");
        $NO_REC = $this->input->post("NO_REC");

        $result = $this->Parts_Model->rcv_cancel($NO_REC, $BILLNO, $RCV_NO, $MT_CODE, $detail_qty);

        $this->response($result, 200);
    }

    public function stock_list_get() {
        header('Content-Type: application/json');
        $result = $this->Parts_Model->stock_list();

        $this->response($result, 200);
    }

    public function test_helper_get() {
        echo xx("abc");
    }

}
