<?php
    //echo "hello";
    session_start();
    session_cache_expire(30);
    include_once('database/dbPersons.php');
    include_once('domain/Person.php');
    $id = str_replace("_"," ",$_GET["id"]);
    $person = retrieve_person($id);
    if (!$person) { // try again by changing blanks to _ in id
        $id = str_replace(" ","_",$_GET["id"]);
        $person = retrieve_person($id);
        if (!$person) {
            echo('<p id="error">Error: there\'s no person with this id in the database</p>' . $id);
            die();
        }
    }
?>
<html lang="">
<head>
    <title>
        Profile
    </title>
    <link rel="stylesheet" href="lib\bootstrap\css\bootstrap.css" type="text/css" />
    <style>
        #appLink:visited {
            color: gray;
        }

        li.list-custom {
            background-color: rgb(250, 249, 246);
        }
    </style>
</head>
<div class="container-fluid">
        <?PHP include('header.php'); ?>
        <div class="square rounded p-5" id="content">
            <?PHP
                echo('Hello, '.$person->get_first_name()."");
            ?>
            <style>
            .square {
              height: 500px;
              width: 500px;
              background-color: #870287;
            }
</style>
        </div>
    </div>
    <?PHP
    include('footer.inc');
    ?>
</body>
</html>