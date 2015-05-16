<?php

if (isset($_SESSION['vaiuugroup']['adminname']) && isset($_SESSION['vaiuugroup']['adminemail']) && $_SESSION['vaiuugroup']['admintype']) {
    $getBlocks=  v_dataSelect("block", "status='active'");
    $getBlocks=$getBlocks['data'];
    include 'view/blocks.php';
} else {
    v_show_404();
}
?>




