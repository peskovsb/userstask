<?php
function form_tree($mess)
{
	if (!is_array($mess)) {
	return false;
	}
	$tree = array();
	foreach ($mess as $value) {
		if(!isset($value['parent_id'])){
			$value['parent_id']=0;
		}	
		$tree[$value['parent_id']][] = $value;
	}
	return $tree;
}

function findSumm($cats, $parent_id, &$summ){
	if (is_array($cats) && isset($cats[$parent_id])) {	
		foreach ($cats[$parent_id] as $cat) {
			
			findSumm($cats, $cat['id'], $cat['count']);
			$summ += $cat['count'];
		}
		
	}
	return $summ;
}

function checkMail($mail){
	if(!preg_match('/^(([^<>()!*%^&#$[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$mail)){
			return false;
		}else{
			return true;
		}
}

function build_tree($cats, $parent_id)
{

	if (is_array($cats) && isset($cats[$parent_id])) {		
	$tree = '<ul>';
	foreach ($cats[$parent_id] as $cat) {
		$root = ($parent_id==0) ? 'root' : '';
		$tree .= '<li class="'.$root.'" data-id="'.$cat['id'].'"><div class="content">ID: '.$cat['id'].' '.$cat['lastname'].' '.$cat['firstname'].' '.$cat['email'].' ';
		
		if(!checkMail($cat['email'])){
			$tree .= '<span style="color:#c11">неверно!</span>';
		}
		$tree .= '(SUMM: '.findSumm($cats, $cat['id'], $cat['count']).')';
		if($parent_id!=0)$tree .= build_tree($cats, $cat['id']);
		$tree .= '</div></li>';
	}
	$tree .= '</ul>';
	} else {
	return false;
	}
	return $tree;
}	
?>