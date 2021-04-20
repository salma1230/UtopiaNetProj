<?php
require_once 'Token.php';

function addquestion($conn){
	//retrieve the current roomID
	$room = $_SESSION['roomID'];
if(isset($_POST['submit']) && Token::check($_POST['token'])){
	$question_number = $_POST['question_number'];
	$question_text = $_POST['question_text'];
	$correct_choice = $_POST['correct_choice'];
	// Choice Array
	$choice = array();
	$choice[1] = $_POST['choice1'];
	$choice[2] = $_POST['choice2'];
	$choice[3] = $_POST['choice3'];
	$choice[4] = $_POST['choice4'];
	$choice[5] = $_POST['choice5'];

 // First Query for Questions Table

	$query = "INSERT INTO questions (";
	$query .= "question_number, question_text, roomID )";
	$query .= "VALUES (";
	$query .= " '{$question_number}','{$question_text}', '{$room}' ";
	$query .= ")";

	$result = mysqli_query($conn,$query);

	//Validate First Query
	if($result){
		foreach($choice as $option => $value){
			if($value != ""){
				if($correct_choice == $option){
					$is_correct = 1;
				}else{
					$is_correct = 0;
				}



				//Second Query for Choices Table
				$query = "INSERT INTO answers (";
				$query .= "question_number,is_correct,coption, roomID)";
				$query .= " VALUES (";
				$query .=  "'{$question_number}','{$is_correct}','{$value}', '{$room}' ";
				$query .= ")";

				$insert_row = mysqli_query($conn,$query);
				// Validate Insertion of Choices

				if($insert_row){
					continue;
				}else{
					die("2nd Query for Choices could not be executed" . $query);

				}

			}
		}
		$message = "Question has been added successfully";
	}

}

		$query = "SELECT * FROM questions WHERE roomID = '$room'";
		$questions = mysqli_query($conn,$query);
		$total = mysqli_num_rows($questions);
		$next = $total+1;
    $_SESSION['nextQuestion'] = $next;


}

function getQuestion($conn){
	//retrieve the current roomID
	$room = $_SESSION['roomID'];
	//Set Question Number
	$number = $_GET['n'];

	//Query for the Question
	$query = "SELECT * FROM questions WHERE question_number = $number AND roomID = '$room'";

	// Get the question
	$result = mysqli_query($conn,$query);
	$question = mysqli_fetch_assoc($result);

	//Get Choices
	$query = "SELECT * FROM answers WHERE question_number = $number AND roomID = '$room'";
	$choices = mysqli_query($conn,$query);
	// Get Total questions
	$query = "SELECT * FROM questions WHERE roomID = '$room'";
	$total_questions = mysqli_num_rows(mysqli_query($conn,$query));

	echo "<div class='current'>Question ".$number." of ".$total_questions." </div>
	<p class='question'> ".$question['question_text']." </p>

	<form method='POST' action='".process($conn)."'>
		<ul class='choicess'>";
			while($row=mysqli_fetch_assoc($choices)){
		echo "	<li><input type='radio' name='choice' value=".$row['id']." >".$row['coption']."</li>";}

echo "</ul>
		<input type='hidden' name='number' value=".$number.">
		<input type='submit' name='submit' value='Submit'>


	</form>";


}

function process($conn){
	//For first question, score will not be there.
if(!isset($_SESSION['score'])){
	$_SESSION['score'] = 0;
}
if($_POST){
	//retrieve the current roomID
	$room = $_SESSION['roomID'];
//We need total question in process file too
$query = "SELECT * FROM questions WHERE roomID = '$room'";
$total_questions = mysqli_num_rows(mysqli_query($conn,$query));

//We need to capture the question number from where form was submitted
$number = $_POST['number'];

//Here we are storing the selected option by user
$selected_choice = $_POST['choice'];

//What will be the next question number
$next = $number+1;

//Determine the correct choice for current question
$query = "SELECT * FROM answers WHERE question_number = $number AND is_correct = 1 AND roomID = '$room'";
 $result = mysqli_query($conn,$query);
 $row = mysqli_fetch_assoc($result);

 $correct_choice = $row['id'];

//Increase the score if selected cohice is correct
 if($selected_choice == $correct_choice){
	$_SESSION['score']++;
 }
	//Redirect to next question or final score page.
 if($number == $total_questions){
	header("LOCATION: quizResult.php");
 }else{
	header("LOCATION: question.php?n=". $next);
 }

}
}

?>
