<?php
include 'header.php';
$routelist = array(
    'login' => "Userlogin",
    'home' => "Dashboard",
    'user' => "User",
    'team' => "Team",
    'game' => "Game",
    'userbonus' => "Bonus",
    'blocks' => "Blocks",
);
if (empty($_GET['adminroute'])) {
    v_show_404();
} else {
    $routekey = $_GET['adminroute'];
    if (array_key_exists($routekey, $routelist)) {
        $routepage = $routelist[$routekey];
    } else {
        v_show_404();
    }
}
include 'controller/' . $routepage . '.php';
include 'footer.php';
?>

