<?php

class User_Model extends CI_Model {

    function __construct() {
        parent::__construct(); // construct the Model class
        $db_217 = $this->load->database('db_217', TRUE);
    }

    public function Get_all_department() {

        $query = $this->db->get("department");


        return $query->result_array();
    }

    public function login_check($array) {
        $db_217 = $this->load->database('db_217', TRUE);
        $where = array(
            "emp_user_name" => $array['username'],
            "emp_password" => md5($array['password'])
        );
        $this->db->select("emp_code, emp_user_name ,emp_title,emp_firstname,emp_lastname ,emp_grp, emp_tec,emp_dept_iD,dept_name_thai");
        $this->db->from("dev_user a");
        $this->db->join("dev_department b","a.emp_dept_id=b.dept_code","left");
        $this->db->where($where);
        $query = $this->db->get();
        $result = array();
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

    public function Get_paytran_list() {
        $db_217 = $this->load->database('db_217', TRUE);

        $db_217->where("CODE_DP", "101-1100-0");
        $query = $db_217->get('paytran');
        $data = $query->result_array();

        $result = array();

        foreach ($data as $key => $value) {
            foreach ($value as $keysub => $val) {
                // $value[$keysub] = iconv('ISO-8859-1', 'UTF-8',$val); 
                $value[$keysub] = $this->tis2utf8($val);

                //$value[$keysub] = $val; 
            }
            $result[] = $value;
        }

        /*
          if(!empty($data)){
          foreach ($data as $key => $value) {
          foreach ($value as $keysub => $val) {
          $value[$keysub] = tis2utf8($val);
          }
          $result[] = $value ;

          }
          //_print_r($result);
          return $result;
          }else{
          return [];
          }

          foreach ($data as $key => $value) {
          foreach ($value as $keysub => $val) {
          foreach ($val as $keysub1 => $val1) {
          $val[$keysub1] = tis2utf8($val1);
          }
          $value[$keysub] = $val ;
          }
          $result[] = $value ;
          }
         */
        return $result;
    }

    //=============== convert utf-8 to tis-620 ================= 
    public function utf8tis620($string) {
        $str = $string;
        $res = "";
        for ($i = 0; $i < strlen($str); $i++) {
            if (ord($str[$i]) == 224) {
                $unicode = ord($str[$i + 2]) & 0x3F;
                $unicode |= (ord($str[$i + 1]) & 0x3F) << 6;
                $unicode |= (ord($str[$i]) & 0x0F) << 12;
                $res .= chr($unicode - 0x0E00 + 0xA0);
                $i += 2;
            } else {
                $res .= $str[$i];
            }
        }
        return $res;
    }

//=============== convert tis-620 to utf-8 ================= 
    public function tis2utf8($tis) {
        $utf8 = "";
        for ($i = 0; $i < strlen($tis); $i++) {
            $s = substr($tis, $i, 1);
            $val = ord($s);
            if ($val < 0x80) {
                $utf8 .= $s;
            } elseif (( 0xA1 <= $val and $val <= 0xDA ) or ( 0xDF <= $val and $val <= 0xFB )) {
                $unicode = 0x0E00 + $val - 0xA0;
                $utf8 .= chr(0xE0 | ($unicode >> 12));
                $utf8 .= chr(0x80 | (($unicode >> 6) & 0x3F));
                $utf8 .= chr(0x80 | ($unicode & 0x3F));
            }
        }
        return $utf8;
    }

}
