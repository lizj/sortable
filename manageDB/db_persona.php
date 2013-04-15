<?php

if (_EXECUTE_INCLUDE == false)
    exit;

if ($_GET['op'] == 1) {
    addPerson();
} elseif ($_GET['op'] == 2) {
    updatePerson();
} elseif ($_GET['op'] == 3) {
    deletePerson();
} 

/**
 * 
 */
function addPerson() {
    $dbhandle = connectDB();
    $first_name = controlFormat($_POST['first-name'], 2);
    $last_name = controlFormat($_POST['last-name'], 2);
    $country = controlFormat($_POST['country'], 2);
    $address = controlFormat($_POST['address'], 2);
    $email = controlFormat($_POST['email'], 2);
    $city = controlFormat($_POST['city'], 2);
    $sql = "INSERT INTO person (first_name,last_name,country,city,address,email) 
        VALUES ('$first_name', '$last_name', '$country', '$city', '$address', '$email');";
    if (!mysqli_query($dbhandle, $sql)) {
        echo 'Error ' . mysqli_error();
        exit;
    }
    echo "1 record added";
}

/**
 * If id is null, list all records using prepared statements
 * @return type 
 */
function listPerson($orderby) {
    $dbhandle = connectDB();
    $id = controlFormat($_POST['id'], 1);
    $orderby = controlFormat($orderby, 2);
    $where = '';
    if (!strcmp($id, 'null') == 0) {
        $where = 'WHERE idperson=' . $id;
    }
    
    $sql = 'SELECT idperson,first_name,last_name,country,city,address,email FROM person ' . $where;
    if (!strcmp($orderby, 'null') == 0) {
        $sql .= " ORDER BY ". $orderby . " ASC";
    }
    
    $result = mysqli_query($dbhandle, $sql);
    return $result;
}

function updatePerson() {
    $dbhandle = connectDB();
    $id = controlFormat($_POST['id'], 1);
    $first_name = controlFormat($_POST['first-name'], 2);
    $last_name = controlFormat($_POST['last-name'], 2);
    $country = controlFormat($_POST['country'], 2);
    $city = controlFormat($_POST['city'], 2);
    $address = controlFormat($_POST['address'], 2);
    $email = controlFormat($_POST['email'], 2);
    
    $sql = "UPDATE person SET first_name='$first_name',
    last_name='$last_name',country='$country',
    city='$city',address='$address',
    email='$email' WHERE idperson=" . $id;
    $result = mysqli_query($dbhandle, $sql);
    return $result;
}

function deletePerson() {
    $dbhandle = connectDB();
    $id = controlFormat($_POST['id'], 1);
    $sql = 'DELETE FROM person WHERE idperson=' . $id;
    $result = mysqli_query($dbhandle, $sql);
    return $result;
}

/**
 * Check and escape the variable type of input
 * @param type $valor input value
 * @param type $type=1 numeric $type=2 string
 * @return type 
 */
function controlFormat($valor, $type) {
    switch ($type) {
        case 1: //numeric
            if (!is_numeric($valor))
                $valor = 'null';
            else
                $valor = intval($valor);
            break;
        case 2: //string
            if (trim($valor) == '' || is_null($valor))
                $valor = 'null';
            else
                $valor = mysql_real_escape_string($valor);
            break;
        default:
            $valor = mysql_real_escape_string($valor);
            break;
    }
    return $valor;
}

/**
 *
 * @param type $string
 * @return type 
 */
function printDate($string) {
    $string = htmlentities(utf8_decode($string), ENT_QUOTES | ENT_IGNORE);
    return $string;
}

/**
 * Connect to database
 * @return type 
 */
function connectDB() {
    $username = "root";
    $password = "";
    $hostname = "localhost";
    $database = "data";

    //connection to the database
    $dbhandle = mysqli_connect($hostname, $username, $password, $database);
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    return $dbhandle;
}

?>
