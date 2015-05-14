<head profile="http://www.w3.org/2005/10/profile">
<link rel="icon" type="image/vnd.microsoft.icon" href="/Img/favicon.ico">

<?php
require("Funções.php");
require("LoginLib.php");
//ligação à base de dados
$connection = mysql_connect("127.0.0.1", "root");
if (!$connection) {
    die('Could not connect: ' . mysql_error());
	}
	

$db_selected = mysql_select_db('gestc');
if (!$db_selected) {
    die ('Can\'t use DB : ' . mysql_error());
}

session_start();

if(isset($_GET['success']) && $_GET['success']=='true')
{
?>


<div id='message' style="display: none;">
    <span>Operação concluída com sucesso.</span>
    <a href="#" class="close-notify">X</a>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $("#message").fadeIn("slow");
    $("#message a.close-notify").click(function() {
        $("#message").fadeOut("slow");
        return false;
    });
});

</script>

<?php

}

?>