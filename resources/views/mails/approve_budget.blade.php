

<html>
<head>
	<title>Activity Planner</title>
</head>
<body>
Hello	
<h4>Your have an Activity Plan Request to approve.</h4>
Requester name: {{ $name }}<br>
Place(s): {{ $place }}<br>
Total Cost: {{ $total_cost }}<br>
Expected Premium: {{ $budget_id }}<br>
Follow link to Approve:<br>
<a href="http://localhost:8000/approve/329382329383293823983238{{ $budget_id }}874393239328923982378923782739237">Redirect to Activity Planner System</a>
<br><br>


Forwarded by: {{ $prev_approved }} <br>

Budget ID: {{ $budget_id }}<br>

	
</body>


</html>