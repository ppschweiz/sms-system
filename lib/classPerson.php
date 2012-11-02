<?php

class Group{
	function __construct($name) {
			 $this->name = $name;
	 }
	 function myname(){
		return $this->name;
	 }
	var $name;
	var $s=array();
	function add($n){
		$this->s[]=$n;
	}

	function trysend(&$q,$f,&$i,$s=0){
		if ($f[$i]===$this->myname()) {
			$i++;
			$s=1;
		}
		foreach ($this->s as $m){
			$m->trysend($q,$f,$i,$s);
		}
	}
	function caption(){
		return $this->name;
	}
	
	function prnt($level=0,$x=0){
		srand(crc32($this->name));
		$r=dechex(rand(8,15));$g=dechex(rand(8,15));$b=dechex(rand(8,15));$l=rand(0,1500);
		echo "<div style='background-color:#".$r.$g.$b.";	margin:6px; padding:6px;'>
			<input type='checkbox' name='reciever[]' value='".$this->name."' onChange='javascript:doChild(this.checked,\"r$l\");'>".$this->caption()."<br>
			<span id='r$l'>
<table>
	<tr>
		<td>";
		foreach ($this->s as $m){
			$x=$m->prnt($level+1,$x);
			if (($level==0) && ($x>15)) {
				echo "</td><td>";
				$x=0;
			}
		}
		echo "</td>
	</tr>
</table>
</span></div>";
		return $x+4;
	}
	
}

//=====================================================
//=====================================================
//=====================================================

class Person extends Group{
//-----------------------------------------------------
//CLASS FIELDS
//-----------------------------------------------------
	var $mobile;
	var $hidden;
//-----------------------------------------------------
//METHODS
//-----------------------------------------------------
	/**
	 * Default class constructor
	 * @param name		String, name of the person
	 * @param mobile	String, cell phone number of the person
	 * @param hidden	Boolean, flag indiciating if the number should be hidden
	 * @return			a new instance of Person
	 **/
	function __construct($name,$mobile,$hidden) {
		parent::__construct($name);
		$this->mobile= $mobile;
		$this->hidden= $hidden;
	}
//-----------------------------------------------------
	function caption(){
		if ($this->hidden==0) {
			return $this->name.' <small>(+'. $this->mobile.')</small>';
		} else {
			return $this->name.' <small>(hidden number)</small>';
		}
	}
//-----------------------------------------------------
	function trysend(&$q,$f,&$i,$s=0){
		if ($f[$i]===$this->myname()) {
			$i++;
			$s=1;
		}
		if ($s===1) {
			$q[]=$this;
		}
	}
//-----------------------------------------------------
	function prnt($level=0,$x=0){
		echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' name='reciever[]' value='".$this->name."'>".$this->caption()."<br>";
		return $x+1;
	}
}
