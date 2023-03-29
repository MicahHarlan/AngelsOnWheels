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
                // link to personal profile for editing
                echo('<br><div class="container-fluid" id="scheduleBox"><p><strong>Edit Profile:</strong><br /></p><ul>');
                echo('</ul><p>Go <strong><a href="personEdit.php?id='.$person->get_id().'">here</a></strong> to edit your account.</p></div>');
                if ($person->get_first_name()=="new")
        	        echo '<p>First Name<span style="font-size:x-small;color:FF0000">*</span>: <input class="form-control-sm" type="text" name="first_name" tabindex="1" value="'.$person->get_first_name().'">';
                else 
        	        echo '<p>First name: '.$person->get_first_name();
                    echo '<p>Last name: '.$person->get_last_name();
                    echo '<p>Address: '.$person->get_address();
                    echo '<p>City: '.$person->get_city();
                    echo '<p>State: '.$person->get_state();
                    echo '<p>Zip: '.$person->get_zip();
                    echo '<p>Primary phone: '.phone_edit($person->get_phone1());
                    echo '<p>Birth date: '.$person->get_birthday();
                    echo '<p>Email address: '.$person->get_email();
                    echo '<p>What is the best time to contact you: '.$person->get_contact_time();
                    echo '<p>What is the best way to contact you: '.$person->get_cMethod();

                    echo '<p>Shirt size: '.$person->get_shirt_size();
                    echo '<p>Do you own a computer: '.$person->get_computer();
                    echo '<p>Do you own a camera: '.$person->get_camera();
                    echo '<p>Do you have reliable transportation: '.$person->get_transportation();
                    echo '<p>Emergency contact name: '.$person->get_contact_name();
                    echo '<p>Emergency contact number: '.$person->get_contact_num();
                    echo '<p>What is your relationship to the emergency contact: '.$person->get_relation();
            ?>
            <style>
                .square{
                    height: 1000px;
                    width: 930px;
                    color: white;
                    background-color: #870287;
                    margin-left: 50px;
                    padding-bottom: 200px;
                }
            </style>
        </div>
    </div>
    <?PHP
    include('footer.inc');
    ?>
</body>
</html>