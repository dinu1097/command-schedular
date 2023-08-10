<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

@include('navbar')

<div class="container">
  <h2>Add A Command</h2>
  <form action="{{ route('commands.store') }}" method="POST">
  @csrf
  @method('post')
  <div class="form-group">
      <label for="email">Flying From:</label>
      <input type="text" class="form-control"  placeholder="Enter From" name="flyingFrom" required>
    </div>
    <div class="form-group">
      <label for="email">Flying To:</label>
      <input type="text" class="form-control"  placeholder="Enter To" name="flyingTo" required>
    </div>
    <div class="form-group">
      <label for="email">Arrival Time:</label>
      <input type="datetime-local" class="form-control"  placeholder="Enter time" name="arrivalTime" step="1" required>
    </div>
    <div class="form-group">
      <label for="email">departure Time:</label>
      <input type="datetime-local" class="form-control"  placeholder="Enter time" name="departureTime" step="1" required>
    </div>
    <div class="form-group">
      <label for="email">Airline</label>
      <input type="text" class="form-control"  placeholder="Enter Airline" name="airline" required>
    </div>
    <div class="form-group">
      <label for="email">Class</label>
      <input type="number" class="form-control"  placeholder="Enter Class" name="class" min="1" max="6" required>
    </div>
    <div class="form-group">
      <label for="email">SubClass</label>
      <input type="text" class="form-control"  placeholder="Enter Class" name="subclass" min="1" max="6" required>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
