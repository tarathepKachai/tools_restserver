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


        $result = array();
        $valuex = array();
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            foreach ($data as $key => $value) {
                $this->db->where("RCV_BILLNO", $data[$key]['BILLNO']);
                $query2 = $this->db->get("rcvtran");
                if ($query2->num_rows() > 0) {
                    // do nothing
                } else {

                    foreach ($value as $keysub => $val) {

                        $valuex[$keysub] = $this->tis2utf8($val);
                    }
                }

                $result[] = $valuex;
            }
            $array = array(
                "status" => TRUE,
                "data" => $result
            );
        } else {
            $array = array(
                "status" => FALSE
            );
        }

        return $array;
    }

    public function Get_paytran_by_id($BILLNO) {
        $db_217 = $this->load->database('db_217', TRUE);
        $where = array(
            "BILLNO" => $BILLNO,
            "CODE_DP" => "101-1100-0"
        );
        $db_217->where($where);
        $query = $db_217->get('paytran');

        $result = array();

        if ($query->num_rows() > 0) {

            $data = $query->result_array();

            foreach ($data as $key => $value) {
                foreach ($value as $keysub => $val) {
                    // $value[$keysub] = iconv('ISO-8859-1', 'UTF-8',$val); 
                    $value[$keysub] = $this->tis2utf8($val);

                    //$value[$keysub] = $val; 
                }
                $result[] = $value;
            }

            $array = array(
                "status" => true,
                "data" => $result
            );
        } else {
            $array = array(
                "status" => false
            );
        }
        return $array;
    }

    public function Get_paydetail_by_id($id) {
        $db_217 = $this->load->database('db_217', TRUE);
        $where = array(
            "a.BILLNO" => $id
        );
        $db_217->select("a.*,b.mt_name,b.mt_unit");
        $db_217->from("paydetail a");
        $db_217->join("master b", "a.mt_code=b.mt_code", "left");
        $db_217->where($where);
        $query = $db_217->get();


        if ($query->num_rows() > 0) {

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

            $array = array(
                "status" => true,
                "data" => $result
            );
        } else {
            $array = array(
                "status" => false
            );
        }
        return $array;
    }

    public function role_exists($key) {
        $this->db->where('rolekey', $key);
        $query = $this->db->get('roles');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function Insert_rcvtran_by_id($BILLNO) {
        $db_217 = $this->load->database('db_217', TRUE);

        foreach ($BILLNO as $BILL) {

            if ($this->Rcv_check($BILL)) {
                // do nothing
                // data's not dup
            } else {
                // data's dup
                $array = array(
                    "status" => "duplicate"
                );
                return $array;
            }

            $where = array(
                "BILLNO" => $BILL
            );

            $db_217->from("paytran");
            $db_217->where($where);
            $query1 = $db_217->get();

            if ($query1->num_rows() > 0) {

                foreach ($query1->result_array() as $paytran) {

                    $data_rcv = array(
                        "RCV_BILLNO" => $paytran['BILLNO'],
                        "RCV_BILLDATE" => $paytran['TRNDATE'],
                        "RCV_SupCode" => "ff",
                        "RCV_NO" => "ff",
                        "RCV_DATE" => "ff",
                        "RCV_REF_NO" => "ff",
                        "RCV_SEC" => "ff",
                        "RCV_CODE_ST" => $this->tis2utf8($paytran['CODE_ST']),
                        "RCV_TYPE" => "ff",
                        "RCV_AMOUNT" => $this->tis2utf8($paytran['AMOUNT']),
                        "RCV_AMOUNTVAT" => "ff",
                        "RCV_DISCOUNT" => "ff",
                        "RCV_DISCAMT" => "ff",
                        "RCV_VAT" => "ff",
                        "RCV_VAT_AMT" => "ff",
                        "RCV_REMARK" => $this->tis2utf8($paytran['REMARK']),
                        "RCV_PERIOD" => $this->tis2utf8($paytran('PERIOD')),
                        "RCV_STATUS" => "ff",
                        "RCV_ID" => "ff",
                        "RCV_TOTNET" => "ff",
                        "User_Create" => "ff",
                        "Time_Create" => "ff",
                        "Date_Create" => "ff",
                        "Comp_Create" => "ff",
                        "User_Update" => "ff",
                        "Time_Update" => "ff",
                        "Date_Update" => "ff",
                        "Comp_Update" => "ff",
                        "User_Cancel" => "ff",
                        "Time_Cancel" => "ff",
                        "Date_Cancel" => "ff",
                        "Comp_Cancel" => "ff"
                    );
                }
            } else {
                
            }
        }

//        $where = array(
//            "RCV_BILLNO" => $BILLNO
//        );
//
//        $this->db->where($where);
//        $query = $this->db->get("rcvtran");
//        if ($query->num_rows() > 0) {
//            $result = array(
//                "status" => false
//            );
//        } else {
//
//            $data = $this->Get_paytran_by_id($BILLNO);
////            $this->db->set($data);
////            $this->db->insert("rcvtran");
//
//            $detail = $this->Get_paydetail_by_id($BILLNO);
//            if ($detail['status'] == true) {
//                $detail_data = $detail['data'];
////                $this->db->set($detail_data);
////                $this->db->insert("rcvdetail");
//            }
//
//            $result = array(
//                "status" => true
//            );
//            $result = array(
//                "tran" => $data,
//                "detail" => $detail_data
//            );
//        }


        return $result;
    }

    public function rcvtran_list() {

        $query = $this->db->get('rcvtran');

        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            $array = array(
                "status" => true,
                "data" => $data
            );
        } else {
            $array = array(
                "status" => false
            );
        }

        return $array;
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

    public function rcvtran_by_id($BILLNO) {

        $where = array(
            "RCVD_BILLNO" => $BILLNO
        );

        $this->db->where($where);
        $query = $this->db->get("rcvtran");

        if ($query->num_rows() > 0) {
            $result = array(
                "status" => true,
                "data" => $query->result_array()
            );
        } else {
            $result = array(
                "status" => false
            );
        }

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

    public function Rcv_check($BILLNO) {
        $db_217 = $this->load->database('db_217', TRUE);

        $where = array(
            "RCV_BILLNO" => $BILLNO
        );
        $db_217->where($where);
        $query = $db_217->get("rcvtran");

        if ($query->num_rows() > 0) {
            return 0;
        } else {
            return 1;
        }
    }

}
