<?php

class Parts_Model extends CI_Model {

    function __construct() {
        parent::__construct(); // construct the Model class
    }

    public function Get_all_department() {

        $query = $this->db->get("department");

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

}
