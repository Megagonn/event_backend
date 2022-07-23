<?php
   
    function insertData($data){
        try {
            $table = $data['table'];
            array_shift($data);
            $keys = join(",",array_keys($data));
            $values = join(",",array_values($data));
            $sql = query("INSERT INTO $table($keys) VALUES($values)");
            return $sql;
        }
        catch(Exception $err){
            
            logerror($err->getMessage());
            return false;
        }
    }
    function updateData($table,$column,$newvalue,$id,$iden){
        $sql = query("UPDATE $table SET $column='$newvalue' WHERE $id='$iden' ");
        if($sql){
            return true;
        }
        else {
            return false;
        }

    }
    function getData($table,$key,$value){
           $sql = query("SELECT * FROM $table WHERE $key='$value' ");
            if(check($sql)<1){
                return false;
            }
            else {
                return fetch($sql);
            }
    }

    function deleteData($table,$key,$value){
        $sql = query("DELETE FROM $table WHERE $key='$value' ");
         if($sql){
             return true;
         }
         else {
             return false;
         }
 }
?>