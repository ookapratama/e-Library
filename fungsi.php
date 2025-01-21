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

    // Validasi table name untuk menghindari SQL injection
    $table = '`' . str_replace('`', '', $table) . '`';

    $values = array_map(function ($value) use ($conn) {
        return "'" . mysqli_real_escape_string($conn, $value) . "'";
    }, $datas);

    $valueString = "(null," . implode(',', $values) . ")";
    $query = "INSERT INTO $table VALUES $valueString";

    if (!mysqli_query($conn, $query)) {
        // Handle error
        throw new Exception("Error: " . mysqli_error($conn));
    }

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

function update($table, $datas, $keys, $id)
{
    global $conn;
    try {
        $updates = [];
    
        // Combine keys and values dengan sanitize
        foreach ($keys as $index => $key) {
            if (isset($datas[$index])) {
                $value = mysqli_real_escape_string($conn, $datas[$index]);
                $updates[] = "`" . $key . "` = '" . $value . "'";
            }
        }
        // Buat query dengan format yang benar
        $setClause = implode(', ', $updates);
        $query = "UPDATE $table SET $setClause WHERE id = " . intval($id);
    
        $result = mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    } catch (\Exception $e) {
        dd($e);
    }
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

// generate kode buku
function generateKode($prefix)
{
    global $conn;
    $sql = "SELECT MAX(CAST(SUBSTRING_INDEX(kdbuku, '-', -1) AS UNSIGNED)) as last_number FROM buku";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $nextNumber = ($row['last_number'] === null) ? 1 : $row['last_number'] + 1;

    $prefix = substr($prefix, 0, 1);

    return $prefix . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
}

// upload file 
function uploadFile($file)
{
    $dir = 'asset/img/buku/';
    $fileName = strtolower($file['name']);
    $targetDir = $dir . $fileName;
    $imageFileType = strtolower(pathinfo($targetDir, PATHINFO_EXTENSION));

    try {
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            return [
                'status' => false,
                'message' => 'No file selected.'
            ];
        }


        if ($file["size"] > 5000000) {
            return [
                'status' => false,
                'message' => "Sorry, your file is too large."
            ];
        }

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'];
        if (!in_array($imageFileType, $allowedTypes)) {
            return [
                'status' => false,
                'message' => "Sorry, only JPG, JPEG, PNG, GIF, PDF, DOC & DOCX files are allowed."
            ];
        }

        $i = 0;
        $newFileName = $fileName;
        while (file_exists($dir . $newFileName)) {
            $i++;
            $fileName_parts = pathinfo($fileName);
            $newFileName = $fileName_parts['filename'] . '_' . $i . '.' . $fileName_parts['extension'];
        }
        $targetDir = $dir . $newFileName;

        if (move_uploaded_file($file["tmp_name"], $targetDir)) {
            return [
                'status' => true,
                'message' => "File has been uploaded successfully.",
                'fileName' => $newFileName
            ];
        } else {
            return [
                'status' => false,
                'message' => "Sorry, there was an error uploading your file."
            ];
        }
    } catch (\Exception $e) {
        return [
            'status' => false,
            'message' => $e->getMessage()
        ];
    }
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
