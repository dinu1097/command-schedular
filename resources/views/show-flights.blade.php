<!DOCTYPE html>
<html>
<head>
    <title>Flights</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Flight Details</h5>
        <p class="card-text">Id : {{ $commandRow['id'] }}</p>
        <p class="card-text">Flying from: {{ $commandRow['flyingFrom'] }}</p>
        <p class="card-text">Flying to: {{ $commandRow['flyingTo'] }}</p>
        <p class="card-text">Arrival Date: {{ $commandRow['arrivalTime'] }}</p>
        <p class="card-text">Departure Date: {{ $commandRow['departureTime'] }}</p>        
        <p class="card-text">Airline: {{ $commandRow['airline'] }}</p>
        <p class="card-text">Class: {{ $commandRow['class'] }}</p>
        <p class="card-text">SubClass: {{ $commandRow['subClass'] }}</p>
        <p class="card-text">Seats: {{ $commandRow['seats'] }}</p>
        <p class="card-text">FlightNumber: {{ $commandRow['flightNumber'] }}</p>
        <p class="card-text">Error Message: {{ $commandRow['errorMessage'] }}</p>
    </div>
</div>

</body>
</html>
