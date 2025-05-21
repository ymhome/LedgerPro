<?php

require_once __DIR__ . '/../database/connect.php';

$keyword = $_GET["dev_search"] ?? '';
$productFilter = $_GET["dev_products"] ?? '';
$companyFilter = $_GET["dev_company"] ?? '';
$statusFilter = $_GET["dev_status"] ?? '';

$sql = "SELECT * FROM device";
$conditions = [];
$params = [];

if(isset($_GET["deviceSearchButton"])){

    if($keyword !== ""){
        $conditions[] = "dev_name LIKE :keyword
                    OR dev_serial LIKE :keyword
                    OR dev_type LIKE :keyword
                    OR dev_dept LIKE :keyword
                    OR dev_usr LIKE :keyword
                    OR dev_spec LIKE :keyword
                    OR dev_buy LIKE :keyword
                    OR dev_other LIKE :keyword
                    OR dev_status LIKE :keyword";
    }

    $params[':keyword'] = "%{$keyword}%";
    
}

if($productFilter !== ''){
    $conditions[] = "dev_type = :product";
    $params[":product"] = $productFilter;
}

if($companyFilter !== ''){
    $conditions[] = "dev_dept = :company";
    $params[":company"] = $companyFilter;
}

if($statusFilter !== ''){
    $conditions[] = "dev_status = :status";
    $params[":status"] = $statusFilter;
}

if(!empty($conditions)){
    $sql .= " WHERE " . implode(" AND ", $conditions);
}


    $stmt = $db->prepare($sql);
    $stmt -> execute($params);
    $dev_search_array = $stmt -> fetchAll(PDO::FETCH_ASSOC);
