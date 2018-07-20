<?php

class Parts_Model extends CI_Model {

    function __construct() {
        parent::__construct(); // construct the Model class
        $db_217 = $this->load->database('db_217', TRUE);
    }

    public function Get_all_department() {

        $query = $this->db->get("department");


        return $query->result_array();
    }

    public function Get_device_by_id($dept_code) {

        $where = array(
            "dept_code" => $dept_code
        );

        $this->db->where($where);
        $query = $this->db->get("device");

        if ($query->num_rows() > 0) {
            $array = array(
                "status" => true,
                "data" => $query->result_array()
            );
        } else {
            $array = array(
                "status" => false,
                "detail" => "no device"
            );
        }

        return $array;
    }

    public function Get_paytran_list() {
        $db_217 = $this->load->database('db_217', TRUE);

        $db_217->where("CODE_DP", "101-1100-0");
        $query = $db_217->get('paytran');


        return $query->result_array();
    }

    public function Get_paytran_by_id($BILLNO) {
        $db_217 = $this->load->database('db_217', TRUE);
        $where = array(
            "BILLNO" => $BILLNO,
            "CODE_DP" => "101-1100-0"
        );
        $db_217->where($where);
        $query = $db_217->get('paytran');


        return $query->result_array();
    }

    public function Get_paydetail_by_id($id) {
        $db_217 = $this->load->database('db_217', TRUE);
        $where = array(
            "BILLNO" => $id
        );
        $db_217->where($where);
        $query = $db_217->get('paydetail');
        if ($query->num_rows() > 0) {
            $array = array(
                "status" => true,
                "data" => $query->result_array()
            );
        } else {
            $array = array(
                "status" => false
            );
        }
        return $array;
    }

    public function Insert_rcvtran_by_id($BILLNO) {
        $db_217 = $this->load->database('db_217', TRUE);

        $where = array(
            "RCV_BILLNO" => $BILLNO
        );

        $this->db->where($where);
        $query = $this->db->get("rcvtran");
        if ($query->num_rows() > 0) {
            $result = array(
                "status" => false
            );
        } else {

            $data = $this->Get_paytran_by_id($BILLNO);
//            $this->db->set($data);
//            $this->db->insert("rcvtran");

            $detail = $this->Get_paydetail_by_id($BILLNO);
            if ($detail['status'] == true) {
                $detail_data = $detail['data'];
//                $this->db->set($detail_data);
//                $this->db->insert("rcvdetail");
            }

            $result = array(
                "status" => true
            );
            $result = array(
                "tran" => $data,
                "detail" => $detail_data
            );
        }


        return $result;
    }

    public function rcvtran_list() {

        $query = $this->db->get('rcvtran');

        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            $result = array(
                "status" => true,
                "data" => $data
            );
        } else {
            $result = array(
                "status" => false
            );
        }

        return $result;
    }

    public function rcvdetail_by_id($BILLNO) {

        $where = array(
            "RCVD_BILLNO" => $BILLNO
        );

        $this->db->where($where);
        $query = $this->db->get("rcvdetail");

        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            $result = array(
                "status" => true,
                "data" => $data
            );
        } else {
            $result = array(
                "status" => false
            );
        }
    }
    
    public function rcvtran_by_id($BILLNO){
        
        $where = array(
            "RCVD_BILLNO" => $BILLNO
        );
        
        $this->db->where($where);
        $query = $this->db->get("rcvtran");
        
        if($query->num_rows()>0){
            $result = array(
              "status" => true,
                "data" => $query->result_array()
            );
        }else{
            $result = array(
                "status" => false
            );
        }
        
        return $result;
        
    }

}
