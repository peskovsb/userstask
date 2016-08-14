<?php
require_once('classPDO.php');
require_once('func.php');

$sql = 'SELECT * FROM users';
	$tb = $db->connection->prepare($sql);
	$tb->execute();
	$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);

$tree = form_tree($arrAll);
if(isset($_POST['id'])) echo '<div class="ajaxContent">'.build_tree($tree,$_POST['id']).'</div>';
?>