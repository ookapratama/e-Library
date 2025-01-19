<?php
//data database
$servername = "localhost";
$database = "perpus";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
function tampil($table)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM $table");
    return $result;
}

function tambah($table, $datas)
{
    global $conn;

    $value = cleanStore($datas);

    $query = "INSERT INTO $table values $value";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cleanStore($datas)
{
    $query = "(null,";
    $lastData = end($datas);
    foreach ($datas as $item) {
        if ($item == $lastData) {
            $query .= "'$item'" . ')';
        } else {
            $query .= "'$item'" . ',';
        }
    }
    return $query;
}

function update($table, $datas, $key, $id)
{
    global $conn;
    // put cleared data to query
    $query = cleanUpdate($datas, $key, $id);
    $result = mysqli_query($conn, "UPDATE $table SET $query");
    return mysqli_affected_rows($conn);
}

// put cleaned data to $query
function cleanUpdate($datas, $key, $id)
{
    $query = '';
    $lastData = end($datas);

    foreach ($datas as $i => $item) {
        if ($item == $lastData) {
            $query .= $key[$i] . '=' . "'$item'" . ' WHERE id=' . "$id";
        } else {
            $query .= $key[$i] . '=' . "'$item'" . ',';
        }
    }
    return $query;
}

function hapus($table, $id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM $table WHERE id=$id");
    return mysqli_affected_rows($conn);
}

// validate form if null
function validateValue($datas)
{
    try {
        foreach ($datas as $i => $data) {
            if (empty($data)) {
                return false;
            }
        }
        return true;
    } catch (\Exception $e) {
        return $e;
    }
}

// validate if data is exist in database
function isExistData($table, $column, $findData, $id = null)
{
    try {
        global $conn;
        $claues = " AND id != $id";
        if ($id == null) {
            unset($claues);
        }
        $result = mysqli_query($conn, "SELECT * FROM $table WHERE $column = '$findData' $claues  ");
        return mysqli_num_rows($result);
    } catch (\Exception $e) {
        dd($e);
    }
}

// clear special characters in form value
function clearCharacters($datas)
{
    $clearedData = array();
    foreach ($datas as $data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        array_push($clearedData, $data);
    }

    return $clearedData;
}




// dump and die
function dd($value)
{
    return die(var_dump($value) . '<br>');
}

// just dump it
function dump($value)
{
    return var_dump($value . '<br>');
}
