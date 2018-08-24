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

//    public function Get_paytran_list() { // OLD  VER
//        $db_217 = $this->load->database('db_217', TRUE);
//
//        $db_217->select("p.*,d.FAC_NAME as dept_name,pe.STRDATE as PERIOD_STRDATE, pe.ENDDATE as PERIOD_ENDDATE, pe.POST as PERIOD_POST, pe.POSTDATE as PERIOD_POSTDATE, pe.USER_NAME as POST_USER, pe.POSTPAY as POSTPAY");
//        $db_217->from("paytran p");
//        $db_217->join("tdepart d", "p.CODE_DP = d.FAC_CODE", "left");
//        $db_217->join("accperiod pe", "p.PERIOD = pe.PERIOD", "left");
//        $db_217->where("p.CODE_DP", "101-1100-0");
//
//        $query = $db_217->get();
//
//        $sql = $db_217->last_query();
//
//        $result = array();
//        $valuex = array();
//        if ($query->num_rows() > 0) {
//            $data = $query->result_array();
//            foreach ($data as $key => $value) {
//                $where_rcv = array(
//                    "RCV_BILLNO" => $data[$key]['BILLNO'],
//                    "Date_Cancel" => NULL
//                );
//                $this->db->where($where_rcv);
//                $query2 = $this->db->get("rcvtran");
//                //$sql2 = $this->db->last_query();
//                if ($query2->num_rows() > 0) {
//                    // do nothing
//                } else {
//                    foreach ($value as $keysub => $val) {
//                        $valuex[$keysub] = $this->tis2utf8($val);
//                        //print_r($this->tis2utf8($val));
//                    }
//                    $result[] = $valuex;
//                }
//            }
//
//            $count = count($result);
//            $array = array(
//                "status" => TRUE,
//                "data" => $result,
//                "count" => $count
//            );
//        } else {
//            $array = array(
//                "status" => FALSE
//            );
//        }
//
//        return $array;
//    }
//    public function Get_paytran_list() {  // VER 1
//        $db_217 = $this->load->database('db_217', TRUE);
//
//        $db_217->select("p.*,d.FAC_NAME as dept_name,pe.STRDATE as PERIOD_STRDATE, pe.ENDDATE as PERIOD_ENDDATE,"
//                . " pe.POST as PERIOD_POST, pe.POSTDATE as PERIOD_POSTDATE, pe.USER_NAME as POST_USER, pe.POSTPAY as POSTPAY,"
//                . " g.descript as group_name,status");
//        $db_217->from("paytran p");
//        $db_217->join("tdepart d", "p.CODE_DP = d.FAC_CODE", "left");
//        $db_217->join("accperiod pe", "p.PERIOD = pe.PERIOD", "left");
//        $db_217->join("grup g", "p.CODE_GP = g.code_gp", "left");
//        $db_217->join("tstatus status", "p.CODE_GP = status.st_code", "left");
//        $where = array(
//            "p.CODE_DP" => "101-1100-0",
////            "p.CODE_GP != " => "01",
////            "p.CODE_GP != " => "03"
//        );
//        $db_217->where($where);
//        $db_217->where("p.CODE_GP != '01' AND p.CODE_GP != '03'");
//        $query = $db_217->get();
//
//        $sql = $db_217->last_query();
//
//        $result = array();
//        $valuex = array();
//        if ($query->num_rows() > 0) {
//            $data = $query->result_array();
//            foreach ($data as $key => $value) {
//                $where_rcv = array(
//                    "RCV_BILLNO" => $data[$key]['BILLNO'],
//                    "Date_Cancel" => NULL
//                );
////                $this->db->where($where_rcv);
////                $query2 = $this->db->get("rcvtran");
////                //$sql2 = $this->db->last_query();
////                if ($query2->num_rows() > 0) {
////                    // do nothing
////                } else {
//                foreach ($value as $keysub => $val) {
//                    $valuex[$keysub] = $this->tis2utf8($val);
//                    //print_r($this->tis2utf8($val));
//                }
//                $result[] = $valuex;
//                // }
//            }
//
//            $count = count($result);
//            $array = array(
//                "status" => TRUE,
//                "data" => $result,
//                "count" => $count
//            );
//        } else {
//            $array = array(
//                "status" => FALSE
//            );
//        }
//
//        return $array;
//    }

    public function Get_paytran_list() {
        $db_217 = $this->load->database('db_217', TRUE);

        $db_217->select("p.*,d.*,pe.*,g.*"
//                . "d.FAC_NAME as dept_name,pe.STRDATE as PERIOD_STRDATE, pe.ENDDATE as PERIOD_ENDDATE,"
//                . " pe.POST as PERIOD_POST, pe.POSTDATE as PERIOD_POSTDATE, pe.USER_NAME as POST_USER, pe.POSTPAY as POSTPAY,"
//                . " g.descript as group_name"
                . "");
        $db_217->from("paytran p");
        $db_217->join("tdepart d", "p.CODE_DP = d.FAC_CODE", "left");
        $db_217->join("accperiod pe", "p.PERIOD = pe.PERIOD", "left");
        $db_217->join("grup g", "p.CODE_GP = g.code_gp", "left");
        $db_217->join("tstatus status", "p.CODE_GP = status.st_code", "left");
        $where = array(
            "p.CODE_DP" => "101-1100-0",
//            "p.CODE_GP != " => "01",
//            "p.CODE_GP != " => "03"
        );
        $db_217->where($where);
        $db_217->where("p.CODE_GP != '01' AND p.CODE_GP != '03'");
        $query = $db_217->get();

        $sql = $db_217->last_query();

        $result = array();
        $valuex = array();
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            foreach ($data as $key => $value) {
                $where_rcv = array(
                    "RCV_BILLNO" => $data[$key]['BILLNO'],
                    "Date_Cancel" => NULL
                );
//                $this->db->where($where_rcv);
//                $query2 = $this->db->get("rcvtran");
//                //$sql2 = $this->db->last_query();
//                if ($query2->num_rows() > 0) {
//                    // do nothing
//                } else {
                foreach ($value as $keysub => $val) {
                    $valuex[$keysub] = $this->tis2utf8($val);
                    //print_r($this->tis2utf8($val));
                }
                $result[] = $valuex;
                // }
            }

            $count = count($result);
            $array = array(
                "status" => TRUE,
                "data" => $result,
                "count" => $count
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
            "p.NO_REC" => $BILLNO,
            "p.CODE_DP" => "101-1100-0"
        );

        $db_217->select("p.*,d.*,"
//                . "d.FAC_NAME as dept_name,"
//                . "pe.STRDATE as PERIOD_STRDATE, pe.ENDDATE as PERIOD_ENDDATE, pe.POST as PERIOD_POST, pe.POSTDATE as PERIOD_POSTDATE, pe.USER_NAME as POST_USER, pe.POSTPAY as POSTPAY,g.descript as group_name"
        );
        $db_217->from("paytran p");
        $db_217->join("tdepart d", "p.CODE_DP = d.FAC_CODE", "left");
        $db_217->join("accperiod pe", "p.PERIOD = pe.PERIOD", "left");
        $db_217->join("grup g", "p.CODE_GP = g.code_gp", "left");
        $db_217->where($where);
        $db_217->where("p.CODE_GP != '01' AND p.CODE_GP != '03'");
        $query = $db_217->get();

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

    public function search_paytran($NO_REC) {
        $db_217 = $this->load->database('db_217', TRUE);

        $where_paytran = array(
            "Pay_No" => $NO_REC
        );
        // if paytran rmms exist or not  
        $this->db->select("p.*,g.*,pe.*");
        $this->db->from("paytran p");
        $this->db->join("grup g", "p.Pay_CODE_GP=g.code_gp", "LEFT");
        $this->db->join("accperiod pe", "p.Pay_PERIOD=pe.PERIOD", "LEFT");
        $this->db->join("dev_tdepart td", "p.Pay_Job_No=td.fac_code", "LEFT");
        $this->db->where($where_paytran);
        $query = $this->db->get();
        $result = array();
        $detail_return = array();
        if ($query->num_rows() > 0) {
            $detail_return = $this->get_pay_record($NO_REC);
            return $detail_return;
        } else {
            $where = array(
                "p.NO_REC" => $NO_REC,
                "p.CODE_DP" => "101-1100-0"
            );
            $db_217->select("p.*,d.*,pe.*,g.*"
//                    . "d.FAC_NAME as dept_name,"
//                    . "pe.STRDATE as PERIOD_STRDATE, pe.ENDDATE as PERIOD_ENDDATE, pe.POST as PERIOD_POST, pe.POSTDATE as PERIOD_POSTDATE, "
//                    . "pe.USER_NAME as POST_USER, pe.POSTPAY as POSTPAY,"
//                    . "g.descript as group_name"
            );
            $db_217->from("paytran p");
            $db_217->join("tdepart d", "p.CODE_DP = d.FAC_CODE", "left");
            $db_217->join("accperiod pe", "p.PERIOD = pe.PERIOD", "left");
            $db_217->join("grup g", "p.CODE_GP = g.code_gp", "left");
            $db_217->where($where);
            $db_217->where("p.CODE_GP != '01' AND p.CODE_GP != '03'");
            $query = $db_217->get();
            if ($query->num_rows() > 0) {
                //$BILL_TEST = array();
                $data = $query->result_array();

                foreach ($data as $key => $value) {
                    foreach ($value as $keysub => $val) {
                        // $value[$keysub] = iconv('ISO-8859-1', 'UTF-8',$val); 
                        $value[$keysub] = $this->tis2utf8($val);
                    }

                    $result[] = $value;
                    $date_now = date("Y-m-d");
                    $time = date("h:i:s");
                    $paytran_data = array(
                        "Pay_Job_No" => $value['FAC_CODE'],
                        "Pay_Date" => $value['TRNDATE'],
                        "Pay_No" => $value['NO_REC'],
                        "Pay_BILLNO" => $value['BILLNO'],
                        "Pay_Dept_ID" => $value['FAC_CODE'],
                        "Pay_CODE_ST" => $value['CODE_ST'],
                        "Pay_CODE_GP" => $value['CODE_GP'],
                        "Pay_REMARK" => $value['REMARK'],
                        "Pay_PERIOD" => $value['PERIOD'],
                        "Pay_AMOUNT" => $value['AMOUNT'],
                        "Pay_Type" => "",
                        "Pay_Status" => "01",
//                        "Pay_ID" => "",
                        "User_Create" => "",
                        "Time_Create" => $time,
                        "Date_Create" => $date_now,
                        "Comp_Create" => "",
//                       "User_Update" => "",
//                        "Time_Update" => "",
//                        "Date_Update" => "",
//                        "Comp_Update" => "",
//                        "User_Cancel" => "",
//                        "Time_Cancel" => "",
//                        "Date_Cancel" => "",
//                        "Comp_Cancel" => "",
                    );
                    //$BILL_TEST[] = $value['BILLNO'];
                    $this->db->insert("paytran", $paytran_data);
                    if ($this->db->affected_rows() > 0) {
                        $detail_return[] = $this->import_paydetail($value['BILLNO']);
//                        $aaa = array(
//                            "status" => "inst paytran"
//                        );
                        // check & insert grup
                        $this->db->where('code_gp', $value['CODE_GP']);
                        $query_grup = $this->db->get('grup');
                        if ($query_grup->num_rows() > 0) {
                            $array_grup = array(
                                //"code_gp" => $value['CODE_GP'],
                                "descript" => $value['descript'],
                                "flag_budg" => $value['instock'],
                                "grpnew" => $value['grpnew'],
                                "newname" => $value['newname'],
                                "ordernow" => $value['ordernow'],
                                "accde" => $value['accde'],
                                "grp_budget" => $value['grp_budget']
                            );
                            $this->db->set($array_grup);
                            $this->db->where("code_gp", $value['code_gp']);
                            $this->db->update("grup");
                        } else {
                            $array_grup = array(
                                "code_gp" => $value['CODE_GP'],
                                "descript" => $value['descript'],
                                "flag_budg" => $value['instock'],
                                "grpnew" => $value['grpnew'],
                                "newname" => $value['newname'],
                                "ordernow" => $value['ordernow'],
                                "accde" => $value['accde'],
                                "grp_budget" => $value['grp_budget']
                            );
                            $this->db->insert("grup", $array_grup);
                        }

                        // check & insert PERIOD

                        $this->db->where('PERIOD', $value['PERIOD']);
                        $query_period = $this->db->get('accperiod');
                        if ($query_period->num_rows() > 0) {
                            foreach ($query_period->result_array() as $period) {

                                $array_period = array(
                                    //"PERIOD" => $value['PERIOD'],
                                    "STRDATE" => $value['STRDATE'],
                                    "ENDDATE" => $value['ENDDATE'],
                                    "POST" => $value['POST'],
                                    "POSTDATE" => $value['POSTDATE'],
                                    "USER_NAME" => $value['USER_NAME'],
                                    "POSTPAY" => $value['POSTPAY']
                                );
                                $this->db->set($array_period);
                                $this->db->where("PERIOD", $value['PERIOD']);
                                $this->db->update("accperiod");
                            }
                        } else {
                            $array_period = array(
                                "PERIOD" => $value['PERIOD'],
                                "STRDATE" => $value['STRDATE'],
                                "ENDDATE" => $value['ENDDATE'],
                                "POST" => $value['POST'],
                                "POSTDATE" => $value['POSTDATE'],
                                "USER_NAME" => $value['USER_NAME'],
                                "POSTPAY" => $value['POSTPAY']
                            );

                            $this->db->insert("accperiod", $array_period);
                        }
                    } else {
                        $aaa = array(
                            "status" => "can't inst paytran"
                        );
                    }
                }

                $detail_return = $this->get_pay_record($NO_REC);

//                $array = array(
//                    "status" => true,
//                    "data" => $result
//                );
            } else {
//                $array = array(
//                    "status" => false
//                );
                $aaa = array(
                    "status" => "dup pay"
                );
                $detail_return = array(
                    "status" => false
                );
            }


            return $detail_return;
        }
    }

    public function import_paydetail($BILLNO) {
        $db_217 = $this->load->database('db_217', TRUE);

        $result = array();
        $return = array();
        $where = array(
            "PayD_No" => $BILLNO,
            "PayD_RCVD_ID != " => "0"
        );
        $this->db->where($where);
        $query = $this->db->get("paydetail");
        if ($query->num_rows() > 0) {

            $return[] = $query->result_array();
        } else {
            $where_detail = array(
                "p.BILLNO" => $BILLNO
            );

            $db_217->select("*");
            $db_217->from("paydetail p");
            $db_217->join("master m", "p.MT_CODE=m.mt_code", "LEFT");
            $db_217->where($where_detail);
            $query_detail = $db_217->get();

            if ($query_detail->num_rows() > 0) {
                $data = $query_detail->result_array();
                foreach ($data as $key => $value) {
                    foreach ($value as $keysub => $val) {
                        // $value[$keysub] = iconv('ISO-8859-1', 'UTF-8',$val); 
                        $value[$keysub] = $this->tis2utf8($val);

                        //$value[$keysub] = $val; 
                    }
                    $result[] = $value;
                    $date_now = date('Y-m-d');
                    $time_now = date('H:i:s');
                    $array_detail = array(
                        "PayD_No" => $value['BILLNO'],
                        "PayD_MT_CODE" => $value['MT_CODE'],
                        "PayD_Qty" => $value['NUM'],
                        "PayD_PRICE" => $value['PRICE'],
                        "PayD_Date" => $value['TRNDATE'],
                        "PayD_PERIOD" => $value['PERIOD'],
                        "PayD_ST_NOW" => $value['ST_NOW'],
//                        "PayD_ID" => "",
                        "PayD_RCVD_ID" => "",
                        "PayD_RCV_No" => "",
                        "PayD_RCVD_Qty" => "0",
                        "PayD_Status" => "01",
                        "User_Create" => "",
                        "Time_Create" => $time_now,
                        "Date_Create" => $date_now,
                        "Comp_Create" => "",
//                        "User_Update" => "",
//                        "Time_Update" => "",
//                        "Date_Update" => "",
//                        "Comp_Update" => "",
//                        "User_Cancel" => "",
//                        "Time_Cancel" => "",
//                        "Date_Cancel" => "",
//                        "Comp_Cancel" => ""
                    );

                    $return[] = $array_detail;

                    $this->db->set($array_detail);
                    $this->db->insert("paydetail");

                    $this->db->where("mt_code", $value['MT_CODE']);
                    $query_master = $this->db->get("master");
                    if ($query_master->num_rows() == 0) {
                        $array_master = array(
                            "mt_code" => $value['mt_code'],
                            "mt_name" => $value['mt_name'],
                            "mt_grp" => $value['mt_grup'],
                            "mt_unit" => $value['mt_unit'],
                            "mt_price" => $value['mt_price'],
                            "mt_max" => $value['mt_max'],
                            "mt_min" => $value['mt_min'],
                            "mt_sav" => $value['mt_sav'],
                            "mt_rep" => $value['mt_tan'],
                            "mt_loc" => $value['mt_loc'],
                            "lastprice" => $value['lastprice'],
                            "lastdate" => $value['lastdate'],
                            "supcode" => "",
                            "balamt" => $value['balamt'],
                            "preamt" => $value['preamt'],
                            "maxlimit" => $value['maxlimit'],
                            "user_name" => $value['user_name'],
                            "mt_status" => "",
                            "instock" => "",
                            "User_Create" => "",
                            "Time_Create" => $time_now,
                            "Date_Create" => $date_now,
                            "User_Update" => "",
                            "Time_Update" => "",
                            "Date_Update" => "",
                            "User_Cancel" => "",
                            "Time_Cancel" => "",
                            "Date_Cancel" => ""
                        );
                        $this->db->set($array_master);
                        $this->db->insert("master");
                    }
                }
                return $return;
            }
        }
    }

    public function get_pay_record($NO_REC) {

        $result = array();
        $result_detail = array();
        $where = array(
            "p.Pay_No" => $NO_REC
        );
        $this->db->select("p.*");
        $this->db->from("paytran p");
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            foreach ($query->result_array() as $paytran) {
                $this->db->where("PayD_No", $paytran['Pay_BILLNO']);
                $detail_row = $this->db->get("paydetail");
                if ($detail_row->num_rows() > 0) {
                    $result_detail[] = $this->get_paydetail_rmms($paytran['Pay_BILLNO']);
                }
            }

            $this->db->select(""
                    . "p.Pay_No, SUM(p.Pay_AMOUNT) as SUM_PRICE,p.Pay_Date as DATE,"
                    . "td.fac_name as Dep_name,g.descript as GROUP_NAME"
                    . "");
            $this->db->from("paytran p");
            $this->db->join("dev_tdepart td", "p.Pay_Dept_ID=td.fac_code", "left");
            $this->db->join("grup g", "p.Pay_CODE_GP=g.code_gp", "left");
            $this->db->where($where);
            $query = $this->db->get();

            $result = array(
                "status" => true,
                "paytran" => $query->result_array(),
                "paydetail" => $result_detail
            );
        }

        return $result;
    }

    public function get_paydetail_rmms($BILLNO) {

        $where = array(
            "p.PayD_No" => $BILLNO
        );
        //$this->db->select("p.*,m.*,g.*,pe.*");
        $this->db->select("p.PayD_No as BILLNO,p.PayD_MT_CODE as MT_CODE,p.PayD_Qty as Amount,"
                . "p.PayD_PRICE as PRICE,(p.PayD_PRICE*p.PayD_Qty) as SUM_PRICE,PayD_RCVD_Qty as  RCV_Qty,"
                . "PayD_RCVD_ID as  RCVD_ID,PayD_RCV_No as RCV_No,"
                . "m.mt_name as MT_NAME , m.mt_unit as MT_UNIT,"
                . "");
        $this->db->from("paydetail p");
        $this->db->join("master m", "p.PayD_MT_CODE = m.mt_code", "left");
        $this->db->join("accperiod pe", "p.PayD_PERIOD = pe.PERIOD", "left");

        $this->db->where($where);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return "No data";
        }
    }

    public function Get_paydetail_by_id($id) {
        $db_217 = $this->load->database('db_217', TRUE);
        $where = array(
            "a.BILLNO" => $id
        );
        $db_217->select("a.*,m.*,pe.*,g.*"
//                . "m.mt_name,m.mt_unit, m.mt_grup as mt_group,"
//                . "pe.STRDATE as PERIOD_STRDATE, pe.ENDDATE as PERIOD_ENDDATE, pe.POST as PERIOD_POST, pe.POSTDATE as PERIOD_POSTDATE, "
//                . "pe.USER_NAME as POST_USER, pe.POSTPAY as POSTPAY,"
//                . "g.descript as group_name"
                . "");
        $db_217->from("paydetail a");
        $db_217->join("master m", "a.mt_code = m.mt_code", "left");
        $db_217->join("accperiod pe", "a.PERIOD = pe.PERIOD", "left");
        $db_217->join("grup g", "m.mt_grup = g.code_gp", "left");
        $db_217->where($where);
        $query = $db_217->get();

        $sss = [];
        $sql = $db_217->last_query();

        if ($query->num_rows() > 0) {

            $data = $query->result_array();

            $result = array();

            foreach ($data as $key => $value) {
                foreach ($value as $keysub => $val) {
                    // $value[$keysub] = iconv('ISO-8859-1', 'UTF-8',$val); 
                    $value[$keysub] = $this->tis2utf8($val);

                    //$value[$keysub] = $val; 
                }

                if ($this->if_exist($value['BILLNO'], $value['ID'])) {
                    $value['rcv_status'] = "1";
                } else {
                    $value['rcv_status'] = "0";
                }

                //$sss[] =$value['BILLNO'];
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

    public function if_exist($BILLNO, $id) {

        $where = array(
            "RCVD_BILLNO" => $BILLNO,
            "RCVD_REF_ID" => $id,
            "Date_Cancel" => NULL
        );
        $this->db->from("rcvdetail");
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
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

//    public function Insert_rcvtran($BILLNO) { // OLD
//        $db_217 = $this->load->database('db_217', TRUE);
//
//        $data_rcv = array();
//        foreach ($BILLNO as $BILL) {
//
//            if ($this->Rcv_check($BILL)) {
//                // do nothing
//                // data's not dup
//            } else {
//                // data's dup
//                $array = array(
//                    "status" => "duplicate",
//                    "BILLNO" => $BILL
//                );
//                return $array;
//            }
//
//            $where = array(
//                "BILLNO" => $BILL
//            );
//
//            $db_217->from("paytran");
//            $db_217->where($where);
//            $query1 = $db_217->get();
//
//            if ($query1->num_rows() > 0) {
//
//                foreach ($query1->result_array() as $paytran) {
//
//                    $today = date("Y-m-d");
//                    $now = date("h:i:sa");
//                    $vat_arr = $this->vat_cal($paytran['AMOUNT']);
//                    $RCV_NO = $this->get_rcv_no();
//                    $data_rcv = array(
//                        "RCV_BILLNO" => $paytran['BILLNO'],
//                        "RCV_BILLDATE" => $paytran['TRNDATE'],
//                        "RCV_SupCode" => $this->tis2utf8($paytran['CODE_DP']),
//                        "RCV_NO" => $RCV_NO,
//                        "RCV_DATE" => "$today",
//                        //"RCV_REF_NO" => "",
//                        //"RCV_SEC" => "",
//                        "RCV_CODE_ST" => $this->tis2utf8($paytran['CODE_ST']),
//                        "RCV_TYPE" => $this->tis2utf8($this->tis2utf8($paytran['TYPEMT'])),
//                        "RCV_AMOUNT" => $this->tis2utf8($paytran['AMOUNT']),
//                        "RCV_AMOUNTVAT" => $vat_arr['AMOUNTVAT'],
//                        //"RCV_DISCOUNT" => "",
//                        //"RCV_DISCAMT" => "",
//                        "RCV_VAT" => $vat_arr['VAT'],
//                        "RCV_VAT_AMT" => $vat_arr['VAT_AMT'],
//                        "RCV_REMARK" => $this->tis2utf8($paytran['REMARK']),
//                        "RCV_PERIOD" => $this->tis2utf8($paytran['PERIOD']),
//                        "RCV_STATUS" => "",
//                        // "RCV_ID" => "ff",
//                        "RCV_TOTNET" => $vat_arr['AMOUNTVAT'],
//                        //"User_Create" => "",
//                        "Time_Create" => $now,
//                        "Date_Create" => $today,
////                        "Comp_Create" => "",
////                        "User_Update" => "",
////                        "Time_Update" => "",
////                        "Date_Update" => "",
////                        "Comp_Update" => "", 
////                        "User_Cancel" => "",
////                        "Time_Cancel" => "",
////                        "Date_Cancel" => "",
////                        "Comp_Cancel" => "",
//                        "Status" => "1"
//                    );
//                    $this->db->set($data_rcv);
//                    //$a = $this->db->get_compiled_insert("rcvtran");
//                    $a = $this->db->insert("rcvtran");
//                    $this->Insert_rcvdetail($BILL, $RCV_NO);
//                }
//            } else {
//                $array = array(
//                    "status" => FALSE
//                );
//                return $array;
//            }
//        }
//
////         $this->db->set($data_rcv);
////         $a = $this->db->get_compiled_insert("rcvtran");
////        $a = $this->db->insert_batch("rcvtran", $data_rcv);
//        //$sql = $this->db->last_query();
//        $array = array(
//            "status" => TRUE
//        );
//        return $array;
//        //return $result;
//    }

    public function Insert_rcvtran($NO_REC, $BILLNO,$DETAIL) {
        $db_217 = $this->load->database('db_217', TRUE);
        
        $data_rcv = array();
        foreach ($BILLNO as $BILL) {
            $where = array(
                "BILLNO" => $BILL
            );

            if ($this->Rcv_check($BILL)) {
                // new record
                $db_217->from("paytran");
                $db_217->where($where);
                $query1 = $db_217->get();

                if ($query1->num_rows() > 0) {

                    foreach ($query1->result_array() as $paytran) {

                        $today = date("Y-m-d");
                        $now = date("h:i:sa");
                        //$vat_arr = $this->vat_cal($paytran['AMOUNT']);
                        $RCV_NO = $this->get_rcv_no();
                        $data_rcv = array(
                            "RCV_BILLNO" => $paytran['BILLNO'],
                            "RCV_BILLDATE" => $paytran['TRNDATE'],
                            "RCV_SupCode" => $this->tis2utf8($paytran['CODE_DP']),
                            "RCV_NO" => $RCV_NO,
                            "RCV_DATE" => "$today",
                            //"RCV_REF_NO" => "",
                            //"RCV_SEC" => "",
                            "RCV_CODE_ST" => $this->tis2utf8($paytran['CODE_ST']),
                            "RCV_TYPE" => $this->tis2utf8($this->tis2utf8($paytran['TYPEMT'])),
                            "RCV_AMOUNT" => "0",
                            "RCV_AMOUNTVAT" => "",
                            //"RCV_DISCOUNT" => "",
                            //"RCV_DISCAMT" => "",
                            "RCV_VAT" => "7",
                            "RCV_VAT_AMT" => "",
                            "RCV_REMARK" => $this->tis2utf8($paytran['REMARK']),
                            "RCV_PERIOD" => $this->tis2utf8($paytran['PERIOD']),
                            "RCV_STATUS" => "",
                            // "RCV_ID" => "ff",
                            "RCV_TOTNET" => "",
                            //"User_Create" => "",
                            "Time_Create" => $now,
                            "Date_Create" => $today,
//                        "Comp_Create" => "",
//                        "User_Update" => "",
//                        "Time_Update" => "",
//                        "Date_Update" => "",
//                        "Comp_Update" => "",
//                        "User_Cancel" => "",
//                        "Time_Cancel" => "",
//                        "Date_Cancel" => "",
//                        "Comp_Cancel" => "",
                            "Status" => "1"
                        );
                        $this->db->set($data_rcv);
                        //$a = $this->db->get_compiled_insert("rcvtran");
                        $a = $this->db->insert("rcvtran");
                        $this->Insert_rcvdetail($BILL, $RCV_NO, $detail_id);
                    }
                } else {
                    $array = array(
                        "status" => FALSE
                    );
                    return $array;
                }
            } else {
                // BILL's dup // update case
//                $array = array(
//                    "status" => "duplicate",
//                    "BILLNO" => $BILL
//                );
//                return $array;
            }
        }

//          $this->db->set($data_rcv);
//          $a = $this->db->get_compiled_insert("rcvtran");
//          $a = $this->db->insert_batch("rcvtran", $data_rcv);
//          $sql = $this->db->last_query();
        $array = array(
            "status" => TRUE
        );
        return $array;
        //return $result;
    }

    public function Insert_rcvdetail($BILLNO, $RCV_NO, $detail_id) {

        $db_217 = $this->load->database('db_217', TRUE);

        foreach ($detail_id as $d_id) {
            $where = array(
                "BILLNO" => $BILLNO
            );
            $db_217->where($where);
            $query1 = $db_217->get('paydetail');

            $val = array();
            if ($query1->num_rows() > 0) {
                $data = $query1->result_array();
                $new_amount = "0";
                foreach ($data as $paydetail) {
                    $today = date("Y-m-d");
                    $now = date("h:i:s");

                    //$vat_arr = $this->vat_cal($paydetail['AMOUNT']);

                    $ST_NOW = $this->check_stock($paydetail);

                    $data_rcv = array(
                        "RCVD_NO" => $RCV_NO,
                        "RCVD_DATE" => $today,
                        "RCVD_BILLNO" => $paydetail['BILLNO'],
                        "RCVD_MT_CODE" => $paydetail['MT_CODE'],
                        "RCVD_QTY" => $paydetail['NUM'],
                        "RCVD_PRICE" => $paydetail['PRICE'],
                        "RCVD_ORD_QTY" => $paydetail['PRICE'],
                        "RCVD_STATUS" => "",
                        "RCVD_VAT" => "",
                        "RCVD_VAT_AMT" => "",
                        "RCVD_PERIOD" => $paydetail['PERIOD'],
                        "RCVD_CODE_ST" => "",
                        "RCVD_BALANCE" => "",
                        "RCVD_ST_NOW" => "",
                        "RCVD_REF_ID" => $paydetail['ID'],
//                    "RCVD_ID" => "",
//                    "User_Create" => "",
                        "Time_Create" => $now,
                        "Date_Create" => $today,
//                    "Comp_Create" => "",
//                    "User_Update" => "",
//                    "Time_Update" => "",
//                    "Date_Update" => "",
//                    "Comp_Update" => "",
//                    "User_Cancel" => "",
//                    "Time_Cancel" => "",
//                    "Date_Cancel" => "",
//                    "Comp_Cancel" => "",
                        "Status" => "1"
                    );
                    $this->db->set($data_rcv);
                    //$a = $this->db->get_compiled_insert("rcvtran");
                    $a = $this->db->insert("rcvdetail");
                    if ($this->db->affected_rows() > 0) {
                        $new_amount = $new_amount + ($paydetail['NUM'] * $paydetail['PRICE']);
                    }
                }

                $where_amount = array(
                    "RCV_NO" => $RCV_NO,
                    "Date_Create" => NULL
                );

                $this->db->where($where_amount);
                $this->db->limit(1);
                $rcvtran = $this->db->get("rcvtran");

                if ($rcvtran->num_rows() > 0) {
                    foreach ($rcvtran->result_array() as $row) {
                        $rcv_up = array(
                            "RCV_AMOUNT" => $row['RCV_AMOUNT'] + $new_amount
                        );
                        $where = array(
                            "RCV_NO" => $RCV_NO,
                            "Date_Create" => NULL
                        );

                        $this->db->set($rcv_up);
                        $query_update = $this->db->update("rcvtran");
                    }
                }


                return 1;
            } else {
                return 0;
            }
        }
    }

    public function rcvtran_cancel($RCV_BILLNO) {

        $where = array(
            "RCV_BILLNO" => $RCV_BILLNO,
            "Date_Cancel" => NULL
        );
        $date = date("Y-m-d");
        $time = date("h:i:s");
        $update = array(
            "Date_Cancel" => $date,
            "Time_Cancel" => $time,
            "Status" => "2"
        );

        $this->db->set($update);
        $this->db->where($where);
        $this->db->update("rcvtran");
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $array = array(
                "status" => FALSE,
                    //"case" => "1"
            );
        } else {

            $where_detail = array(
                "RCVD_BILLNO" => $RCV_BILLNO,
                "Date_Cancel" => NULL
            );

            $this->db->where($where_detail);
            $query = $this->db->get("rcvdetail");

            if ($query->num_rows() > 0) {
                $update_detail = array(
                    "Date_Cancel" => $date,
                    "Time_Cancel" => $time,
                    "Status" => "2"
                );
                $this->db->set($update_detail);
                $this->db->where($where_detail);
                $this->db->update("rcvdetail");
                if ($this->db->trans_status() === FALSE) {
                    $array = array(
                        "status" => FALSE,
                            //"case" => "2"
                    );
                } else {
                    $array = array(
                        "status" => TRUE,
                            // "case" => "2"
                    );
                }
            } else {
                $array = array(
                    "status" => TRUE,
                        //"case" => "3"
                );
            }
        }

        return $array;
    }

    public function rcvtran_list() {
        $where = array(
            "Date_Cancel" => NULL
        );
        $this->db->where($where);
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
            "RCVD_BILLNO" => $BILLNO,
            "Date_Cancel" => NULL
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
        $sql = $this->db->last_query();
        return $result;
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
            "RCV_BILLNO" => $BILLNO,
            "Date_Cancel" => NULL
        );
        $this->db->where($where);
        $query = $this->db->get("rcvtran");

        if ($query->num_rows() > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    public function check_stock($paydetail) {

        $st_update = "";

        $where = array(
            "ST_MT_CODE" => $MT_CODE
        );
        $this->db->where($where);
        $query = $this->db->get('stock');
        if ($query->num_rows() > 0) {

            foreach ($query->result_array() as $stock) {
                $st_update = $stock['ST_NOW'] + $QT;
            }

            $data = array(
                "ST_NOW" => $st_update
            );
            $this->db->set($data);
            $this->db->where($where);
            $query2 = $this->db->update("stock");
        } else {
            $period = (date("Y") + 543) . date("m");
            $data = array(
                "ST_MT_CODE" => $paydetail['MT_CODE'],
                "ST_DATE" => date('Y-m-d'),
                "ST_BOM" => "",
                "ST_NOW" => $paydetail['NUM'],
                "ST_RCV" => "",
                "ST_MRCV" => "",
                "ST_RCVEXP" => "",
                "ST_INP" => "",
                "ST_RET" => "",
                "ST_PAY" => "",
                "ST_OUT" => "",
                "ST_BCK" => "",
                "ST_MBCK" => "",
                "ST_UPD" => "",
                "CODE_ST" => $paydetail['CODE_ST'],
                "PERIOD" => $period,
                //"ST_ID" => "", //PRI
                "ST_PRICE" => ""
            );
        }
    }

    public function vat_cal($amount) {

        $vat = "7";
        $vat_amt = ($amount * ($vat / 100));
        $amount_vat = $vat_amt + $amount;


        $array = array(
            "AMOUNTVAT" => $amount_vat,
            "VAT" => $vat,
            "VAT_AMT" => $vat_amt
        );
        return $array;
    }

    public function get_rcv_no() {

        $sql = "SELECT max(RCV_NO) as RCV_NO FROM rcvtran ; ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $temp = (int) $row['RCV_NO'];
                $RCV_NO = $temp + 1;
            }
        } else {
            $RCV_NO = "1";
        }

        return $RCV_NO;
    }

}
