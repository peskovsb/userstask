<?php
require_once('classPDO.php');
require_once('func.php');

$sql = 'SELECT * FROM users';
	$tb = $db->connection->prepare($sql);
	$tb->execute();
	$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);



$tree = form_tree($arrAll);
echo build_tree($tree,0);
echo "<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>";
$js = <<<JS
<script type='text/javascript'>
	$(document).ready(function(){
		$('.root').click(function(){
			$('.ajaxContent').remove();
			getId = $(this).attr('data-id');
			$.ajax({
			  type: "POST",
			  data: {'id':getId},
			  url: "ajaxRequest.php",
			  success: function(data){
				$('.root[data-id='+getId+']').children().after(data);
			  }
			});
		});
	});
</script>
JS;
echo $js;