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
        <div style="padding-top: 20px"></div>
        <div class="square rounded p-1" id="content">
            <?PHP
                echo '<div style="margin-left:80px">';
                if ($person->get_first_name()=="new")
        	        echo '<p>First Name<span style="font-size:x-small;color:FF0000">*</span>: <input class="form-control-sm" type="text" name="first_name" tabindex="1" value="'.$person->get_first_name().'">';
                else 
                    echo '<h3>Personal Information</h3>';
                    echo '<div class="rounded-circle text-center" style="float:right; margin-right:100px; width: 150px; height: 150px; background-color: white; color:#870287"><p style="padding-top:8px;font-size:11;">T-Shirt Size</p>';
                    echo '<p style="font-size:40px; padding-top:0px;">' .$person->get_shirt_size() . '</p></div>';
                    echo '<div class="rounded-circle text-center" style="clear: both; float:right; margin-right:200px; width: 150px; height: 150px; background-color: white; color:#870287"><p style="padding-top:12px;font-size:11;">Computer Owner</p>';
                    echo '<p style="font-size:40px;">' .$person->get_computer() . '</p></div>';
                    echo '<div class="rounded-circle text-center" style="clear: both; float:right; margin-right:100px;width: 150px; height: 150px; background-color: white; color:#870287"><p style="padding-top:12px;font-size:11;">Camera Owner</p>';
                    echo '<p style="font-size:40px;">' .$person->get_camera() . '</p></div>';
                    echo '<div class="rounded-circle text-center" style="clear: both; float:right; margin-right:200px;width: 150px; height: 150px; background-color: white; color:#870287"><p style="padding-top:22px;font-size:11;">Reliable Transportation</p>';
                    echo '<p style="font-size:40px;">' .$person->get_transportation() . '</p></div>';
        	        echo '<table><tr valign=top><td style="color:white">Name:</td></tr>';
                    echo '<tr valign=top><td style="color:white; height:50px">' . $person->get_first_name() . ' ' . $person->get_last_name() . '</td></tr>';
                    echo '<tr valign=top style="color:white"><td>Address: </td></tr>';
                    echo '<tr valign=top style="color:white"><td>' . $person->get_address() . '</td></tr>';
                    echo '<tr valign=top style="color:white; height:50px"><td>' . $person->get_city() .', ' . $person->get_state() .' '. $person->get_zip() . '</td></tr>';
                    echo '<tr valign=top style="color:white"><td>Primary phone: </td></tr>';
                    echo '<tr valign=top style="color:white; height:50px"><td>' . phone_edit($person->get_phone1()) . '</td></tr>';
                    echo '<tr valign=top style="color:white"><td>Birthday: </td></tr>';
                    echo '<tr valign=top style="color:white; height:50px"><td>' . $person->get_birthday() . '</td></tr>';
                    echo '<tr valign=top style="color:white"><td>Email address: </td></tr>';
                    echo '<tr valign=top style="color:white; height:50px"><td>' . $person->get_email() . '</td></tr>';
                    echo '<tr valign=top style="color:white"><td>Contact time: </td></tr>';
                    echo '<tr valign=top style="color:white; height:50px"><td>' . $person->get_contact_time() . '</td></tr>';
                    echo '<tr valign=top style="color:white"><td>Preferred Method of Contact: </td></tr>';
                    echo '<tr valign=top style="color:white; height:50px"><td>' . $person->get_cMethod() . '</td></tr></table>';
                    echo '<h3>Emergency Contact Information</h3>';
                    echo '<div style="margin-left:80px"></div>';
                    echo '<table><tr valign=top><td style="color:white">Name:</td></tr>';
                    echo '<tr valign=top><td style="color:white; height:50px">' . $person->get_contact_name() . '</td></tr>';
                    echo '<tr valign=top style="color:white"><td>Telephone Number: </td></tr>';
                    echo '<tr valign=top style="color:white; height:50px;"><td>' . $person->get_contact_num() . '</td></tr>';
                    echo '<tr valign=top style="color:white"><td>Relationship: </td></tr>';
                    echo '<tr valign=top style="color:white; height:50px;"><td>' . $person->get_relation() . '</td></tr></table>';
                    // link to personal profile for editing
                echo('<br><div class="container-fluid" id="scheduleBox" style="text-align:center"><p><strong>Edit Profile:</strong><br /></p><ul>');
                echo('</ul><p>Go <strong><a href="personEdit.php?id='.$person->get_id().'">here</a></strong> to edit your account.</p></div>');
                echo '</div>';
            ?>
            <style>
                .square {
                height: 1000px;
                width: 930px;
                color: white;
                background-color: #870287;
                margin-left: 150px;
                padding-bottom: 200px;
                }
            </style>
        </div>
        <div style="padding-bottom: 150px"></div>

</div>
    <?PHP
    include('footer.inc');
    ?>
</body>
</html>