<?php

include_once('dbinfo.php');

/**
 * Add dbFeedback
 * 
 */
function create_dbFeedback() {
    $con=connect();
    mysqli_query($con,"DROP TABLE IF EXISTS dbFeedback");
    
    $result = mysqli_query($con,"CREATE TABLE dbLog ( id int(10) NOT NULL AUTO_INCREMENT,name VARCHAR(20), feedback TEXT, date date, PRIMARY KEY(id))");
    if (!$result)
        echo mysqli_error($con);
    mysqli_close($con);
}

/**NEED TO TEST
 * adds a new log entry, using the current date for the timestamp
 */

function add_feedback_entry($name,$feedback) {

    $date = date("Y-m-d");
    $con=connect();
    $query = "INSERT INTO dbFeedback ($name, $feedback, $date) VALUES (\"" . $name . "\",\"" . $feedback . "\",\"" . $date . "\")";
    $result = mysqli_query($con,$query);
    if (!$result) {
        echo mysqli_error($con);
    }
    mysqli_close($con);
}

/**
 * deletes a feedback entry
 */
function delete_feedback_entry($id) {
    $con=connect();
    $query = "DELETE FROM dbFeedback WHERE id=\"" . $id . "\"";
    $result = mysqli_query($con,$query);
    if (!$result)
        echo mysqli_error($con);
    mysqli_close($con);
}

/**
 * deletes feedback entries with ids specified in array $ids
 * @param array of feedback ids
 */
function delete_feedback_entries($ids) {
    $con=connect();
    for ($i = 0; $i < count($ids); ++$i) {
        $query = "DELETE FROM dbFeedback WHERE id=\"" . $ids[$i] . "\"";
        $result = mysqli_query($con,$query);
        if (!$result)
            echo mysqli_error($con);
    }
    mysqli_close($con);
}

/**
 * returns all Feedback entries
 * @return array of id, name, feedback, and date
 */
function get_feedback() {
    $con=connect();
    $query = "SELECT * FROM dbFeedback";
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    if (!$result) {
        die("error getting log");
    } else {
        for ($i = 0; $i < mysqli_num_rows($result); ++$i) {
            $result_row = mysqli_fetch_row($result);
            if ($result_row) {
                $fb[] = array($result_row[0],$result_row[1], $result_row[2], $result_row[3]);
            }
        }
    }
    return $fb;
}

?>
