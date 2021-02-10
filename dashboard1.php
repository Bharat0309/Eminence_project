<?php
require ("user_auth.php");
echo "Hello";
?>
<a href="dashboard.php">Dashboard</a><br/>
<a href="logout.php">Logout</a>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
setInterval(function(){
	check_user();
},2000);
function check_user(){
	jQuery.ajax({
		url:'user_auth.php',
		type:'post',
		data:'type=ajax',
		success:function(result){
			if(result=='logout'){
				window.location.href='logout.php';
			}
		}
		
	});
}
</script>
