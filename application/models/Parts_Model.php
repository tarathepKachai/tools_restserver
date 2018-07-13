<?php

class Parts_Model extends CI_Model {

    function __construct() {
        parent::__construct(); // construct the Model class
        $db_217 = $this->load->database('db_217', TRUE);
    }

    public function Get_all_department() {

        $query = $this->db->get("department");

<<<<<<< HEAD
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

    public function Get_paydetail_by_id($id) {
        $db_217 = $this->load->database('db_217', TRUE);

        $db_217->where("BILLNO", $id);
        $query = $db_217->get('paydetail');


        return $query->result_array();
    }
=======
        return $query->result();
    }

    public function Get_device_by_id($dept_code) {

        $where = array(
            "dept_code" => $dept_code
        );

        $this->db->where($where);
        $query = $this->db->get("device");
        
        if($query->num_rows()>0){
            $array = array(
              "status" => true,
                "data" => $query->result()
            );
        }else{
            $array = array(
              "status" => false,
                "detail" => "no device"
            );
        }
        
        return $array;
        
    }
>>>>>>> a3f92fc47d1d31743a1606e82e9f81be44e0b4b0

}
