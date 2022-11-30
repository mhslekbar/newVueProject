<?php
    header("Access-Control-Allow-Origin: *");
    $results = [];
    $results['error'] = false;
    $results['message'] = "";
    $results['status'] = "";

    require "../classes/init_class.php";

    $do = $_GET['do'] ?? null;
    $Cars = new Cars();

    if($do == "read"):
        if(empty($Cars->get())) {
            $results['error'] = false;
            $results['message'] = "No Cars yet..";
        }else {
            $results['Cars'] = $Cars->get();
        }
    elseif($do == "createCar"):
        $name = htmlspecialchars($_POST['name']);
        $price = htmlspecialchars($_POST['price']);
        $modelYear = htmlspecialchars($_POST['modelYear']);
        $description = htmlspecialchars($_POST['description']);
        $imageName = $_FILES['image']['name'];
        $imageTmp  = $_FILES['image']['tmp_name'];

        if(empty($imageName)) {
            $formErrors[] = "Image is required"; 
        }
        move_uploaded_file($imageTmp, "../assets/cars_image/" . $imageName);        
        $res = $Cars->querry("INSERT","Name = ?, Price = ?, ModelYear = ?,  Description = ?, Image = ?, Date = now()",
        [$name, $price, $modelYear, $description, $imageName]);
        if($res) {
            $results['status'] = 200;
            $results['error'] = false;
            $results['message'] = "Car Added Successfully";
        } else {
            $results['status'] = 180;
            $results['error'] = true;
            $results['message'] = "Failed Saving car information";
        }

    elseif($do == "updateCar"):
        $id = htmlspecialchars($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $price = htmlspecialchars($_POST['price']);
        $modelYear = htmlspecialchars($_POST['modelYear']);
        $description = htmlspecialchars($_POST['description']);
        $imageName = $_FILES['imageCar']['name'];
        $imageTmp = $_FILES['imageCar']['tmp_name'];

        move_uploaded_file($imageTmp, "../assets/cars_image/" . $imageName);        
        $res = $Cars->querry("UPDATE","Name = ?, Price = ?, ModelYear = ?,  Description = ?, Image = ? WHERE ID = ?",
        [$name, $price, $modelYear, $description, $imageName, $id]);
        if($res) {
            $results['status'] = 200;
            $results['error'] = false;
            $results['message'] = "Car Updated Successfully";
        } else {
            $results['status'] = 180;
            $results['error'] = true;
            $results['message'] = "Failed Updating car information";
        }

    elseif($do == "deleteCar"):
        $id = htmlspecialchars($_POST['ID']);
        $res = $Cars->querry("DELETE"," WHERE ID = ?", [$id]);
        if($res) {
            $results['status'] = 200;
            $results['error'] = false;
            $results['message'] = "Car Deleted Successfully";
        } else {
            $results['status'] = 180;
            $results['error'] = true;
            $results['message'] = "Failed Deleted car information";
        }
    endif;
       
    


    echo json_encode($results);

