<?php

class City{

    public $id;
    public $cityName;

    public static function  selectAllCities($tableName,$conn){

        //select all the client from database, and inset the rows results in an array $data[]
        $sql = "SELECT id, cityName FROM $tableName";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $table=[];
        while($row = mysqli_fetch_assoc($result)) {
        $table[]=$row;
        }
        return $table;
        }
        }


        static function selectCityById($tableName,$conn,$id){
            //select a client by id, and return the row result
            $sql = "SELECT cityName FROM $tableName WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
        return $row;
        
        }}}

}

?>