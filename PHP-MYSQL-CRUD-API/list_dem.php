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

    $items = new Demande($db);

    $stmt = $items->getDemandes();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $demArr = array();
       
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_dem" =>  $id_dem,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "mat" => $mat,
                "pay" => $pay,
                "adr" => $adr,
                "tel" => $tel,
                "date_deb" => $date_deb,
                "date_fin" => $date_fin,
                "date_dem" => $date_dem,
                "type_con" => $type_con,
                "mail" => $mail
            );

            array_push($demArr, $e);
        }
        echo json_encode($demArr);
    }
?>