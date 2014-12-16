<?php
if (!v_get_getpass()) {
    v_reDirect(BASE_URL . "logout.php");
}
$user=v_cash_data();
?>
