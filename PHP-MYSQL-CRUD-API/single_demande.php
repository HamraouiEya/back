<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-Requested-With, 
    Content-Type, Origin, Cache-Control, Pragma, Authorization, 
    Accept, Accept-Encoding");
    header("Content-Type: application/json;");
    
    include_once 'config/database.php';
    include_once 'class/demande.php';

    $database = new DB();
    $db = $database->getConnection();

    $item = new Demande($db);

    $item->id_dem = isset($_GET['id_dem']) ? $_GET['id_dem'] : die();
  
    $item->getSingleUser();

    if($item != null){
        $dem_Arr = array(
            "id_dem" =>  $item->id_dem,
            "first_name" => $item->first_name,
            "last_name" => $item->last_name,
            "mat" => $item->mat,
            "pay" => $item->pay,
            "adr" => $item->adr,
            "tel" => $item->tel,
            "date_deb" => $item->date_deb,
            "date_fin" => $item->date_fin,
            "date_dem" => $item->date_dem,
            "type_con" => $item->type_con,
            "mail" => $item->mail
        );
      
        http_response_code(200);
        echo json_encode($dem_Arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Demande record not found.");
    }
?>

