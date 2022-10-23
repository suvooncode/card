<?php
if(isset($_SESSION["user_id"]))
{
	 $user_id = $_SESSION["user_id"];
}
function setsessioncookie($id)
{
	if(isset($_SESSION["user_login_id"]))
	{
		$user_login_id= $_SESSION["user_login_id"];
		setcookie("user_login_id", $user_login_id, time() + (86400 * 30), "/");
	}
}

function findmyuser($user_id)
{
	$find= find("first","users","*"," where user_id='$user_id'",array());
	$parent_id= $find["parent_id"];
	$parent_idarray= find("all","parent_table","*"," where user_parent_id ='$user_id'",array());
	foreach($parent_idarray as $key=>$val)
	{
		$storeid= $val["user_id"];
		array_push($_SESSION["myuser"],$storeid);

		$findtobeparent =  find("all","parent_table","*"," where user_parent_id ='$storeid'",array());
		if($findtobeparent)
		{
			findmyuser($storeid);
		}

	}
}

function myreporthead($user_id)
{
	$findparenttable= find("first","users","parent_id"," where user_id='$user_id'",array());
	$parent_id = $findparenttable["parent_id"];

	$parent_idarray= find("all","parent_table","*"," where parent_id ='$parent_id'",array());
	foreach($parent_idarray as $key=>$val)
	{
		$storeid= $val["user_parent_id"];
		array_push($_SESSION["reportuser"],$storeid);
		myreporthead($storeid);
	}

}

function findleaddetails($lead_id)
{
	$leadtable= " lead as l inner join company as c on c.company_id=l.lead_company_id inner join company_contactdetails as con on con.con_det_id= l.lead_contact_id ";
	$_SESSION["myuser"]=array($_SESSION["user_id"]);
	$findmyusercall=findmyuser($_SESSION["user_id"]);
	$idarray = implode(",",$_SESSION["myuser"]);
	unset($_SESSION["myuser"]);
	$findlead= find("first",$leadtable,"*","where l.lead_id='$lead_id' and l.assigned_user_id IN ($idarray)",array());
	return $findlead;
}

function findrequirmentdetails($req_id)
{
	$rqtype_arr = array("1"=>"ELS","2"=>"SHTD","3"=>"Solutions","4"=>"Staff Agumentation");
	$requirementtable= "requirements as r inner join lead as l on r.lead_id=l.lead_id inner join company as c on c.company_id=l.lead_company_id inner join company_contactdetails as con on con.con_det_id= l.lead_contact_id ";
	$_SESSION["myuser"]=array($_SESSION["user_id"]);
	$findmyusercall=findmyuser($_SESSION["user_id"]);
	$idarray = implode(",",$_SESSION["myuser"]);
	unset($_SESSION["myuser"]);
	$findreq= find("first",$requirementtable,"*","where r.requirement_id='$req_id' and l.assigned_user_id IN ($idarray)",array());

	$req_meta_arr= array();
	$requirement_meta = "requirement_meta";
	$findreqmeta= find("all",$requirement_meta,"*"," where requirement_id='$req_id' ",array());
	foreach($findreqmeta as $key=>$val)
	{
		$arr= array($val["meta_key"]=>$val["meta_value"]);
		$req_meta_arr=array_merge($req_meta_arr,$arr);

	}
	$rq_type= $rqtype_arr[$findreq["requirement_type"]];

	return array("req_det"=>$findreq , "req_meta"=>$req_meta_arr , "req_type"=>$rq_type);
}

?>
