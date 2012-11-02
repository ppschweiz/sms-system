<?php
//=====================================================

function getpart($ret){
	return ((!empty($ret)) && is_array($ret)?explode(":",$ret[0]):array());
}

//=====================================================

function postdef($field,$defaultValue=null){
	return adef($_POST,$field,$defaultValue);
}

//=====================================================
	
function adef($array,$field,$defaultValue=null){
	return (isset($array[$field])?$array[$field]:$defaultValue);
}

//=====================================================

function addContacts(){
	$r=Contacts::$string;
	//$r = explode("\n",$r);
	//$r = explode("\n\r",$r);
	$r = explode("\r\n",$r);
	$g = new Group("All");
	//print_r($r);
	addnx($g,$r);
	return $g;
}

//=====================================================

function addnx($g,$m,&$i=-1){
	while (true) {
		$i++;
		//if (($m[$i]===null)||($m[$i]==="<"))
		if ((!isset($m[$i]))||($m[$i]==="<")) {
			break;
		}
		$pos = strrpos($m[$i], "=");
		if ($pos === false) {
			$q=new Group($m[$i]);
			addnx($q,$m,$i);
			$g->add($q);
		} else {
			$m[$i] = explode("=",$m[$i]);
			if (substr($m[$i][1],-1)=="*"){
				$m[$i][1]=substr($m[$i][1],0,-1);
				$g->add(new Person($m[$i][0],$m[$i][1],1));
			} else {
				$g->add(new Person($m[$i][0],$m[$i][1],0));
			}
		}
	};
}

//=====================================================

function file2($s){
	/*if (!@file('no_file')) {
		echo "<b>Script not working atm!</b> there was an error with a necessary php function<br/><br/>";
		return '';
	}*/
	//return file($s);
	return "";
}

?>
