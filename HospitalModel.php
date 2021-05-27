
<?php
    class HospitalModel extends gf{
        private $param;
        private $dir;
        private $conn;
        function __construct($array){
            $this->param = $array["json"];
            $this->dir = $array["dir"];
            $this->conn = $array["db"];
            $this->project_name = $array["project_name"];
            $this->file_manager = $array["file_manager"];
            $this->result = array(
                "result" => null,
                "error_code" => null,
                "message" => null,
                "value" => null,
            );
            $this->session = $array["session"];
        }
        /********************************************************************* 
        // 함 수 : empty 체크
        // 설 명 : array("id","pw")
        // 만든이: 안정환
        *********************************************************************/
        function value_check($check_value_array){
            $object = array(
                "param"=>$this->param,
                "array"=>$check_value_array
            );
            $check_result = $this->empty_check($object);
            if($check_result["result"]){//param 값 체크 비어있으면 실행 안함
                if($check_result["value_empty"]){//필수 값이 비었을 경우
                    $this->result["result"]="0";
                    $this->result["error_code"]="101";
                    $this->result["message"]=$check_result["value_key"]."가 비어있습니다.";
                    return false;
                }else{
                    return true;
                }
            }else{
                $this->result["result"]="0";
                $this->result["error_code"]="100";
                $this->result["message"]=$check_result["value"]." 가 없습니다.";
                return false;
            }
        }

        function id_check()
        {
            $param = $this->param;

            $id = $this->null_check($param["id"]);

            $sql = "select count(*) as count from hospital where id = $id";
            $this->result = $this->conn->db_select($sql);            

            echo $this->jsonEncode($this->result, JSON_UNESCAPED_UNICODE);
        }

        function phone_check()
        {
            $param = $this->param;

            $type = $param["type"];
            $phone = $this->null_check($param["phone"]);

            $sql = "select count(*) as count from hospital where $type = $phone";
            $this->result = $this->conn->db_select($sql);

            echo $this->jsonEncode($this->result, JSON_UNESCAPED_UNICODE);
        }

        function email_check()
        {
            $param = $this->param;

            $type = $param["type"];
            $email = $this->null_check($param["email"]);

            $sql = "select count(*) as count from hospital where $type = $email";
            $this->result = $this->conn->db_select($sql);

            echo $this->jsonEncode($this->result, JSON_UNESCAPED_UNICODE);
        }


        function hospital_check()
        {
            $param = $this->param;

            $name = $this->null_check($param["name"]);

            $sql = "select count(*) as count from hospital where hp_name = $name";
            $this->result = $this->conn->db_select($sql);

            echo $this->jsonEncode($this->result, JSON_UNESCAPED_UNICODE);
        }


        function join()
        {
            $param = $this->param;

            if($this->value_check(array("id","password","re_password", "manager", "birth", "phone", 
            "email", "hp_name", "hp_admin_name", "hp_birth", "business_num", "hp_call", "hp_email", 
            "hp_zonecode", "hp_address1", "hp_address2", "hp_reception")))
            {
                $this->result = $param;

                

            }


            echo $this->jsonEncode($this->result, JSON_UNESCAPED_UNICODE);
        }
    }
?>