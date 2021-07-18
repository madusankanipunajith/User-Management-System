<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		User List
	</title>
</head>
<body>
	<h1>Student List</h1>
	<ul>
		<?php foreach($students as $student) :?>
			<li><?= $student->id."  ". $student->name."  ".$student->age."  ".$student->school;?></li>
		<?php endforeach ;?>
	</ul>
</body>
</html>
