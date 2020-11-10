<?php

function upload_image()
{
    if(isset($_FILES["user_image"]))
    {
        $extension = explode('.', $_FILES['user_image']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = '../../img/' . $new_name;
        move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
        return $new_name;
    }
}

function get_image_name($user_id)
{
    include('../../traitements/database.php');
    $statement = $connect->prepare("SELECT image FROM utilisateurs WHERE id = '$user_id'");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        return $row["image"];
    }
}

function get_total_all_records()
{
    include('../../traitements/database.php');
    $statement = $connect->prepare("SELECT * FROM utilisateurs");
    $statement->execute();
    $result = $statement->fetchAll();
    return $statement->rowCount();
}
