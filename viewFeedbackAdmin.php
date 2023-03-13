<?php

session_cache_expire(30);
session_start();
?>

<html>
	<head>
		<title>
			View Feedback
		</title>
		

<link type="text/css" rel="stylesheet" href="./styles.css" />
	</head>
	<body>
		<div id="container">
			<?PHP include('header.php');?>
			<div id="content">
				<?php
				include('database/dbFeedback.php');
				if(array_key_exists("del_selected",$_POST)){
					$del=$_POST['delete'];
					delete_feedback_entries($del);
				}
				else if(array_key_exists("del_all",$_POST)){
					$feedback=get_feedback();
					for($i=0;$i<count($feedback);++$i){
						$to_delete[]=$feedback[$i][0];
					}
					delete_feedback_entries($to_delete);
				}
				$feedback=get_feedback();

                if(!is_countable($feedback)){

                    echo 'There is currently no feedback from volunteers';
                }else if (is_countable($feedback)){
               
				echo ('<form method="POST"><br><table class="feedback-table">' .
						'<tr><td colspan="3"><strong>All Feedback</strong></td>' .
						'<td  align="right"><input type="submit" value="Delete All Feedback" name="del_all"><br>' .
						'
				    </td></tr>' .
						'<tr><td><strong>Name</strong></td><td><strong>Feedback</strong></td><td><strong>Date</strong></td>
					<td><input type="submit" value="Delete Selected Feedback" name="del_selected"></td></tr>');
				echo ('<tr></tr>');

				for($i=0;$i<count($feedback);++$i) {
					echo ('<tr><td>'.$feedback[$i][1].'</td><td>'.$feedback[$i][2].'</td><td>'.$feedback[$i][3].'</td><td align="center"><input type="checkbox" name="delete[]" value="'.$feedback[$i][0].'">
					</td></tr>');
				}
				echo ('</table>');
            }
				?>
				
			</div>
			<?PHP include('footer.inc');?>
		</div>
	</body>
</html>
