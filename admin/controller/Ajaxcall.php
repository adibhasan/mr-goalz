<?php
ob_start();
include '../../Generic.php';
if (empty($_POST['method']) || $_POST['method'] == "") {
    $response = array(
        "message" => "Direct access is not allowed",
        "success" => false,
        "styleclass" => "danger",
        "field" => ""
    );
    echo json_encode($response);
    die();
}
if ($_POST['method'] == "addteam") {
    tokenCheck($_POST['token']);
    authenTicate("Team name", true, 2, 100, "", "teamname", $_POST['teamname']);
    authenTicate("Team description", true, 2, 1000, "", "description", $_POST['description']);
    authenTicate("Team play type", true, 2, 100, "", "playtype", $_POST['playtype']);
    authenTicate("Team status", true, 2, 100, "", "status", $_POST['status']);
    addTeam($_POST);
}

function addTeam($data) {
    $dataarray = array();
    unset($data['method']);
    unset($data['token']);
    foreach ($data as $key => $value) {
        $dataarray[$key] = $value;
    }
    $team = $dataarray['teamname'];
    $checkexist = v_dataSelect("team", "teamname='$team'");
    if ($checkexist['counter'] > 0) {
        $response = array(
            "message" => "Team already exists.",
            "success" => false,
            "styleclass" => "danger",
            "field" => ""
        );
        echo json_encode($response);
        die();
    } else {
        $dataarray['createdate'] = date("Y-m-d H:i:s");
        $dataarray['updatedate'] = date("Y-m-d H:i:s");
        $teaminsert = v_dataInsert("team", $dataarray);
        if ($teaminsert) {
            $response = array(
                "message" => "Team has been successfully inserted.",
                "success" => true,
                "styleclass" => "success",
                "field" => ""
            );
            echo json_encode($response);
            die();
        } else {
            $response = array(
                "message" => "Team insertion has been failed.",
                "success" => false,
                "styleclass" => "danger",
                "field" => ""
            );
            echo json_encode($response);
            die();
        }
    }
}

?>
