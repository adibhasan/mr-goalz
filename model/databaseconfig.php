<?php

function v_dataInsert($tablename, $dataarray) {
    $link = databaseConnector();
    $returnstring = createInsertString($dataarray);
    $column = $returnstring['columnname'];
    $columnvalue = $returnstring['columnvalue'];
    $query = "INSERT INTO " . $tablename . " ( " . $column . " ) " . " VALUES " . " ( " . $columnvalue . " ) ";
    $result = mysqli_query($link, $query);
    databaseClose($link);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function v_dataInsert_LastId($tablename, $dataarray) {
    $link = databaseConnector();
    $returnstring = createInsertString($dataarray);
    $column = $returnstring['columnname'];
    $columnvalue = $returnstring['columnvalue'];
    $query = "INSERT INTO " . $tablename . " ( " . $column . " ) " . " VALUES " . " ( " . $columnvalue . " ) ";
    $result = mysqli_query($link, $query);
    $lastinsertid = mysqli_insert_id($link);
    $dataresult['result'] = $result;
    $dataresult['lastinsertid'] = $lastinsertid;
    databaseClose($link);
    return $dataresult;
}

function v_dataSelect($tablename, $conditions) {
    $link = databaseConnector();
    $result = array();
    $query = "SELECT * FROM " . $tablename . " WHERE " . $conditions;
    $psql = mysqli_query($link, $query);
    $count = mysqli_num_rows($psql);
    if ($count == 0) {
        $result['counter'] = 0;
    } else {
        $result['counter'] = 1;
    }
    while ($row = mysqli_fetch_assoc($psql)) {
        $result['data'][] = $row;
    }
    databaseClose($link);
    return $result;
}

function v_comlex_query_league($conditions) {
    $link = databaseConnector();
    $query = "SELECT SUM(t.total_play) AS final_total,SUM(t.team_score) AS final_score FROM(";
    $query.=" SELECT COUNT(*) AS total_play, SUM(team1points) AS team_score FROM upcominggames WHERE team1='$conditions'  AND status='completed'";
    $query.=" UNION";
    $query.=" SELECT COUNT(*) AS total_play, SUM(team2points) AS team_score FROM upcominggames WHERE team2='$conditions'  AND status='completed'";
    $query.=" ) AS t";
    $psql = mysqli_query($link, $query);
    $count = mysqli_num_rows($psql);
    if ($count == 0) {
        $result['counter'] = 0;
    } else {
        $result['counter'] = 1;
    }
    while ($row = mysqli_fetch_assoc($psql)) {
        $result['data'][] = $row;
    }
    databaseClose($link);
    return $result;
}

function v_all_league($id) {
    // SELECT l.groupid,l.groupname
    // FROM usergroup AS l, enrolegroup AS e
    // WHERE l.groupid=e.groupid AND e.userid=26 AND e.status="active"
    $link = databaseConnector();
    $query = "SELECT l.groupid,l.groupname";
    $query.=" FROM usergroup AS l, enrolegroup AS e";
    $query.=" WHERE l.groupid=e.groupid AND e.userid='$id' AND e.status='active'";

    $psql = mysqli_query($link, $query);
    $count = mysqli_num_rows($psql);
    if ($count == 0) {
        $result['counter'] = 0;
    } else {
        $result['counter'] = 1;
    }
    while ($row = mysqli_fetch_assoc($psql)) {
        $result['data'][] = $row;
    }
    databaseClose($link);
    return $result;
}

function v_complex_query_history($id) {
    $link = databaseConnector();
    $query_string = "SELECT m.team1score,m.team2score,m.points1,m.points2,m.points3,u.team1score AS team1Goal,u.team2score AS team2Goal,u.team1,u.team2,m.calculatedtime_stamp";
    $query_string.=" FROM upcominggames AS u, myguess AS m";
    $query_string.=" WHERE m.gameid=u.id AND m.status=\"calculated\" AND userid='$id'";
    $psql = mysqli_query($link, $query_string);
    $count = mysqli_num_rows($psql);
    if ($count == 0) {
        $result['counter'] = 0;
    } else {
        $result['counter'] = 1;
    }
    while ($row = mysqli_fetch_assoc($psql)) {
        $result['data'][] = $row;
    }
    databaseClose($link);
    return $result;
}

function v_dataUpdate($tablename, $dataarray, $conditions) {
    $link = databaseConnector();
    $returnstring = createUpdateString($dataarray);
    $updatestring = $returnstring['string'];
    $query = "UPDATE " . $tablename . " SET " . $updatestring . " WHERE " . $conditions;
    $result = mysqli_query($link, $query);
    if ($result) {
        return true;
    } else {
        return false;
    }
    databaseClose($link);
}

function v_dataDelete($tablename, $conditions) {
    $link = databaseConnector();
    $query = "DELETE FROM " . $tablename . " WHERE " . $conditions;
    $result = mysqli_query($link, $query);
    if ($result) {
        return true;
    } else {
        return false;
    }
    databaseClose($link);
}

function v_unique_info($table, $column, $condition) {
    $teambyid = v_dataSelect($table, $condition);
    $return = $teambyid['data'][0][$column];
    return $return;
}

function databaseConnector() {
    $database = "mrgoalz_vgb";
    $host = "localhost";
    $user = "root";
    $password = "";
    //$host = "50.62.209.88:3306";
    //$user = "mrgoalz";
    //$password ="Password123";
    $link = mysqli_connect($host, $user, $password, $database);
    if (mysqli_connect_errno()) {
        $response = array(
            'message' => "Database connection failed",
            'errordetails' => "Failed to connect to MySQL: " . mysqli_connect_error(),
            'messageclass' => "danger"
        );
        echo json_encode($response);
        die();
    } else {
        return $link;
    }
}

function databaseClose($link) {
    mysqli_close($link);
}

// This function create a string for insert into database table
function createInsertString($dataarray) {
    foreach ($dataarray as $key => $value) {
        $dataarray[$key] = addslashes($value);
    }
    $columnname = "";
    $columnvalue = "";
    $result = array();
    foreach ($dataarray as $key => $value) {
        $columnname = $columnname . $key . ",";
        $columnvalue = $columnvalue . "'" . $value . "',";
    }
    $result['columnname'] = substr($columnname, 0, -1);
    $result['columnvalue'] = substr($columnvalue, 0, -1);
    return $result;
}

// This function create a string for update database table
function createUpdateString($dataarray) {
    foreach ($dataarray as $key => $value) {
        $dataarray[$key] = addslashes($value);
    }
    $result = array();
    $string = "";
    foreach ($dataarray as $key => $value) {
        $string = $string . $key . "=" . "'" . $value . "',";
    }
    $result['string'] = substr($string, 0, -1);
    return $result;
}
?>

