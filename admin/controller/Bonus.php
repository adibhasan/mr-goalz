<?php

if (isset($_SESSION['vaiuugroup']['adminname']) && isset($_SESSION['vaiuugroup']['adminemail']) && $_SESSION['vaiuugroup']['admintype']) {
    $allbonus = v_dataSelect("user_bonus", "status!='deleted'");
    $monthbonus = v_dataSelect("user_bonus", "bonus_type='monthly bonus' AND bonus_year='" . date("Y") . "' AND bonus_month='" . date("m") . "' AND status='active'");
    if ($monthbonus['counter'] != 0) {
        $monthbonus_status = true;
    } else {
        $monthbonus_status = false;
    }
    $performancebonus = v_dataSelect("user_bonus", "bonus_type='performance bonus' AND bonus_year='" . date("Y") . "' AND bonus_month='" . date("m") . "' AND status='active'");

    if ($performancebonus['counter'] != 0) {
        $performance_status = true;
    } else {
        $performance_status = false;
    }
    include 'view/bonus.php';
} else {
    v_show_404();
}
?>


