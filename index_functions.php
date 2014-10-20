<?php
include_once("adb.php");

class index_functions extends adb{
	    function index_functions(){
        adb::adb();
    }
	//SEATS
	function get_seats(){
	$query="select * from seats";
	return $this->query($query);
	}
	
	function get_available_seats($id){
	$query="select * from seats where s_id=$id";
	return $this->query($query);
	}
	
	function update_available_seats($id,$s,$l){
	$query="update seats set seats=$s, location='$l' where s_id=$id";
	if ($this->query($query)){
	return true;
		}
	}
	
	//RESERVED
	function get_reserved_seats(){
	$query="select * from reserved";
	return $this->query($query);
	}
	
	function add_reserved_seats($n,$c,$l){
	$query="insert into reserved set name='$n',code=$c,location='$l',date=CURDATE(),cost=5";
	return $this->query($query);
	}
	
	function get_number(){
	$query="select count(*) from reserved";
	return $this->query($query);
	} 
	
	function get_a_reserved_seat($n){
	$query="select * from reserved where name like'%$n%'";
	return $this->query($query);
	}
	
	function delete_a_reserved_seat($id){
	$query="delete from reserved where r_id=$id";
	return $this->query($query);
	}
}
?>