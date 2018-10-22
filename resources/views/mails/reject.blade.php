

<html>
<head>
	<title>Activity Planner</title>
</head>
<body>
Hello	
<h4>Budget Request Rejected.</h4>
<p>Message: {{ $msg }}</p>
<p>Budget Details</p>

Requester name: {{ $name }}<br>
Place(s): {{ $place }}<br>
Total Cost: {{ $total_cost }}<br>
Expected Premium: {{ $budget_id }}<br>

Please, review and make considerably changes.

Login to Activity Planner for more details:<br>
<a href="http://localhost:8000/login">Activity Planner System</a>
<br><br>

Your budget has been rejected by: {{ $prev_approved }} <br>

	
</body>


</html>