<?php
class OpdModel extends CI_Model {

    public function insertOpdDetails($data){
        $this->db->insert('opd',$data);
    }

    public function getMaxSerial(){
        $nextId = $this->db->query('SELECT AUTO_INCREMENT
        FROM information_schema.TABLES
        WHERE TABLE_SCHEMA = "hospital"
        AND TABLE_NAME = "opd" ')->result_array();
        return $nextId[0]['AUTO_INCREMENT'];
    }


    public function prepareReceiptNo($id){
        $zero="";
        $digitsNeeded = 4 - strlen($id);
        for($i=1; $i<=$digitsNeeded;$i++){
                $zero.="0";
        } 
        return $zero.$id;
}

}