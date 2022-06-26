<?php

if(@!$sock = fsockopen('www.google.com.br',80,$errno, $errstr,5)){

    $_SESSION['net'] = "";
    echo '<script>location.href = "index.php"</script>';
 }

?>