 <?PHP  
    // Only managers for adding and edit
    if ($_SESSION['access_level'] == 2)
	    if ($id == 'new') {
	        echo('<p><strong>Add Campaign Page</strong><br />');
	        echo('Adding a new campaign to the database. ' .
	        '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
        } else { //When an Admin clicks a Campaign this displays
	        echo '<p><strong>Edit Form</strong>';
	        echo('Here you can edit and delete an event in the database.' .
	        '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
	    } 
        if ($_SESSION['access_level']==2) {
            echo '<br> (<span style="font-size:x-small;color:FF0000">*</span> denotes required information).';
            }
    ?>
    <form method="POST">
    <input type="hidden" name="old_id" value=<?PHP echo("\"" . $id . "\""); ?>>
    <input type="hidden" name="_form_submit" value="1">
    <table>
        <tr>&nbsp;&nbsp;&nbsp; Name of Campaign<span style="font-size:x-small;color:FF0000">* </span> 
             <input type="text" name="name"></tr>
        <br>
        <br>
        <tr>&nbsp;&nbsp;&nbsp; Description of Campaign<span style="font-size:x-small;color:FF0000">* </span> 
        <br>
        &nbsp;&nbsp;&nbsp; <textarea name="description" rows="2" cols="75"></textarea>
        </tr>
    </table>
    <?PHP
    if ($_SESSION['access_level'] == 2)
            echo('<br>');
            echo('&nbsp;&nbsp;&nbsp;<input class="btn btn-success" type="submit" value="Submit" name="Submit"><br /><br />');
        ?>
        
</form>