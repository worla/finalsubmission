<?php
	include("gen.php");
	$cmd=get_datan("cmd");
	
	switch($cmd){
	//BUS SEATS
	case 1:
		get_seats();
		break;
	case 2:
		get_available_seats();
		break;
	case 3:
		update_available_seats();
		break;
	//RESERVED SEATS
	case 4:
		get_reserved_seats();
		break;
	case 5:
		get_number();
		break;
	case 6:
		get_a_reserved_seat();
		break;
	case 7:
		delete_a_reserved_seat();
		break;
	case 8:
		add_reserved_seat();
		break;
	default:
		echo "{";
		echo jsonn("result",0). ",";
		echo jsons("message","unknown command");
		echo "}";
	}
	
	function get_seats(){
	include ("index_functions.php");
	$id=get_datan("id");
	$v=new index_functions();
	$v->get_seats();
		$row=$v->fetch();
		if(!$row){
			echo "{";
			echo jsonn("result",0). ",";
			echo jsons("message","seat not found");
			echo "}";
			return;
		}
		while($row){
		echo "{";
			echo jsonn("result",1) .",";
			echo '"busapp":{';
			echo jsonn("id",$id).",";
			echo jsonn("seats",$row['seats']).",";
			echo jsonn("default_seats",$row['default_seats']).",";
			echo jsons("location",$row['location']);
			echo "}";
			echo "}";
	$row=$v->fetch();
		}
		return;
	}
	
	function get_available_seats(){
	include_once ("index_functions.php");
	$id=get_datan("id");
	$v=new index_functions();
	$v->get_available_seats($id);
	$row=$v->fetch();
		if(!$row){
			echo "{";
			echo jsonn("result",0). ",";
			echo jsons("message","number of seats not found");
			echo "}";
			return;
		}
		echo "{";
			echo jsonn("result",1) .",";
			echo '"busapp":{';
			echo jsonn("id",$id).",";
			echo jsonn("s_id",$row['s_id']).",";
			echo jsonn("seats",$row['seats']);
			echo "}";
		echo "}";
	}
	
	function update_available_seats(){
	include ("index_functions.php");
	$v=new index_functions();
	$id=get_datan("id");
	$s=get_datan("n");
	$l=get_data("l");
	if(!$v->update_available_seats($id,$s,$l)){
	echo mysql_error();
	echo'{"result":0,"message":"error updating"}';
	}
	else{
	echo'{"result":1,"message":"updated"}';
	}
	}
	
	function get_reserved_seats(){
	include ("index_functions.php");
	$id=get_datan("id");
	$v=new index_functions();
	$v->get_reserved_seats();
		$row=$v->fetch();
		if(!$row){
			echo "{";
			echo jsonn("result",0). ",";
			echo jsons("message","seat not found");
			echo "}";
			return;
		}
			echo "{";
			echo '"busapp":';
			$s=Array();
			do{
			array_push($s,$row);
			$row=$v->fetch();
			}while($row);
			print_r(json_encode($s));
			echo "}";
		}

	
	function get_number(){
	include ("index_functions.php");
	$id=get_datan("id");
	$v=new index_functions();
	$v->get_number();
		$row=$v->fetch();
		if(!$row){
			echo "{";
			echo jsonn("result",0). ",";
			echo jsons("message","seat not found");
			echo "}";
			return;
		}
		while($row){
		echo "{";
			echo jsonn("result",1) .",";
			echo '"busapp":{';
			echo jsonn("id",$id).",";
			echo jsonn("number",$row['count(*)']);
			echo "}";
		echo "}";
	$row=$v->fetch();
		}
		return;
	}
	
	function add_reserved_seat(){
	include("index_functions.php");
	$v=new index_functions();
	$c=mt_rand(100000,999999);
	$n=get_data("n");
	$l=get_data("l");
	if(!$v->add_reserved_seats($n,$c,$l)){
	echo mysql_error();
	echo '{"result":0,"message":"reserve not added!!!"}';
	}
	else{
	echo '{"result":1,"message":"reserve added!!!"}';
	}
	}
	
	function get_a_reserved_seat(){
	include_once ("index_functions.php");
	$n=get_data("n");
	$v=new index_functions();
	$v->get_a_reserved_seat($n);
	$row=$v->fetch();
		if(!$row){
			echo "{";
			echo jsonn("result",0). ",";
			echo jsons("message","number of seats not found");
			echo "}";
			return;
		}
		echo "{";
			echo jsonn("result",1) .",";
			echo '"busapp":{';
			echo jsonn("r_id",$row['r_id']).",";
			echo jsons("name",$row['name']).",";
			echo jsonn("code",$row['code']);
			echo "}";
		echo "}";
	}
?>