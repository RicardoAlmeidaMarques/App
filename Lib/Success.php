<?php
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