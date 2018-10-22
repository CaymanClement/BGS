

<html>
<head>
	<title>Activity Planner</title>
</head>
<body>
Hello
<h4>Your Activity Plan has been approved</h4>

Requester name: {{ $name }}<br>
Place(s): {{ $place }}<br>
Total Cost: {{ $total_cost }}<br>
Expected Premium: {{ $budget_id }}<br>

Login to Activity Planner for more details:<br>
<a href="http://localhost:8000/login">Activity Planner System</a>
<br><br>


Approved by: {{ $prev_approved }} <br>

Budget ID: {{ $budget_id }}<br>

	

	
</body>


</html>