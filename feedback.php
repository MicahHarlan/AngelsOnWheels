<!DOCTYPE html>
<html lang="en">
<head>
    <title>Angels On Wheels Feedback Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include jQuery library for sliders -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <!-- Add script to initialize sliders -->
    <script>
        $(function() {
            $( "#satisfaction-slider" ).slider({
                range: "min",
                value: 3,
                min: 1,
                max: 5,
                step: 1,
                slide: function( event, ui ) {
                    $( "#satisfaction" ).val( ui.value );
                }
            });
            $( "#satisfaction" ).val( $( "#satisfaction-slider" ).slider( "value" ) );

            $( "#recommend-slider" ).slider({
                range: "min",
                value: 3,
                min: 1,
                max: 5,
                step: 1,
                slide: function( event, ui ) {
                    $( "#recommend" ).val( ui.value );
                }
            });
            $( "#recommend" ).val( $( "#recommend-slider" ).slider( "value" ) );

            $( "#volunteer-slider" ).slider({
                range: "min",
                value: 3,
                min: 1,
                max: 5,
                step: 1,
                slide: function( event, ui ) {
                    $( "#volunteer" ).val( ui.value );
                }
            });
            $( "#volunteer" ).val( $( "#volunteer-slider" ).slider( "value" ) );
        });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        h1 {
            text-align: center;
            margin-top: 30px;
            color: #585858;
        }
        form {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.2);
        }
        label, p {
            font-size: 16px;
            color: #585858;
            margin-bottom: 10px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            font-size: 16px;
            color: #585858;
            box-sizing: border-box;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        input[type="submit"] {
            display: block;
            margin: 0 auto;
            background-color: #0099cc;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0086b3;
        }
        .ui-slider-horizontal {
            height: 8px;
            background-color: #ccc;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .ui-slider-handle {
            height: 20px;
            width: 20px;
            background-color: #0099cc;
            border: none;
            border-radius: 50%;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.5);
            top: -6px;
            outline: none;
        }
        .ui-slider-range {
            background-color: #0099cc;
            border-radius: 10px;
        }
        .slider-labels {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-size: 14px;
            color: #585858;
            margin-top: -5px;
            margin-bottom: 10px;
        }
        .slider-labels label {
            flex: 1;
            text-align: center;
        }
    </style>
</head>
<body>
<h1>Angels On Wheels Feedback Form</h1>
<form method="post">
    <p>How satisfied are you with Angels On Wheels?</p>
    <div class="slider-labels" style="padding-top: 15px;">
        <label>1 (Very Unsatisfied)</label>
        <label>2</label>
        <label>3</label>
        <label>4</label>
        <label>5 (Very Satisfied)</label>
    </div>
    <input type="text" id="satisfaction" name="satisfaction" readonly>
    <div id="satisfaction-slider"></div>
    <p style="padding-top: 15px;">How likely are you to recommend others to contribute to Angels On Wheels?</p>
    <div class="slider-labels" style="padding-top: 15px;">
        <label>1 (Not Likely)</label>
        <label>2</label>
        <label>3</label>
        <label>4</label>
        <label>5 (Very Likely)</label>
    </div>
    <input type="text" id="recommend" name="recommend" readonly>
    <div id="recommend-slider"></div>

    <p style="padding-top: 15px;">How likely are you to encourage others to volunteer for Angels On Wheels?</p>
    <div class="slider-labels" style="padding-top: 15px;">
        <label>1 (Not Likely)</label>
        <label>2</label>
        <label>3</label>
        <label>4</label>
        <label>5 (Very Likely)</label>
    </div>
    <input type="text" id="volunteer" name="volunteer" readonly>
    <div id="volunteer-slider"></div>

    <p style="padding-top: 15px;">Any recommendations you have for Angels On Wheels? (Optional)</p>
    <textarea name="recommendations" rows="9" cols="50" style="resize: none;"></textarea><br>

    <p style="padding-top: 15px;">Your name (Optional):</p>
    <input type="text" name="name">
    <div style="padding-top: 40px;">
        <input type="submit" name="submit" value="Submit">
    </div>
</form>

<?php
// Check if form is submitted
if(isset($_POST['submit'])) {
    // Store form data in variables
    $satisfaction = $_POST['satisfaction'];
    $recommend = $_POST['recommend'];
    $volunteer = $_POST['volunteer'];
    $recommendations = $_POST['recommendations'];
    $name = $_POST['name'];
    $date = date("Y-m-d");

    // Display submitted data
    echo "<h2>Thank you for your feedback!</h2>";
    if (!empty($name)) {
        echo "<p>Name: " . $name . "</p>";
    }
    echo "<p>Date: " . $date . "</p>";
    echo "<p>Satisfaction: " . $satisfaction . "</p>";
    echo "<p>Recommend: " . $recommend . "</p>";
    echo "<p>Volunteer: " . $volunteer . "</p>";
    echo "<p>Recommendations: " . $recommendations . "</p>";

    // Create alert box using JavaScript
    echo "<script>alert('Thank you for your feedback! Your response has been recorded.');</script>";

    // Redirect back to home page after a delay
    echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 2000);</script>";
}
?>

</body>
</html>
