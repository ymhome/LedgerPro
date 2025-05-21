<?php

require_once __DIR__ . '/../database/connect.php';

$keyword = $_GET["usr_search"] ?? '';

$sql = "SELECT * FROM usr";
$conditions = [];
$params = [];

if(isset($_GET["usrSearchButton"])){

    if($keyword !== ""){
        $conditions[] = "usr_name LIKE :keyword
                    OR usr_mail LIKE :keyword
                    OR usr_authority LIKE :keyword";
    }

    $params[':keyword'] = "%{$keyword}%";
    
}

if(!empty($conditions)){
    $sql .= " WHERE " . implode(" AND ", $conditions);
}


    $stmt = $db->prepare($sql);
    $stmt -> execute($params);
    $usr_search_array = $stmt -> fetchAll(PDO::FETCH_ASSOC);
