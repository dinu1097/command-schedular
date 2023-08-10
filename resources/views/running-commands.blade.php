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

<!-- resources/views/show_commands.blade.php -->
<div class="container">
    <h2>Running Commands</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Flying From</th>
                <th>Flying To</th>
                <th>Arrival Time</th>    
                <th>Departure Time</th>
                <th>Airline</th>
                <th>Class</th>
                <th>Subclass</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commands as $command)
                <tr>
                    <td>{{ $command->id }}</td>
                    <td>{{ $command->flyingFrom }}</td>
                    <td>{{ $command->flyingTo }}</td>
                    <td>{{ $command->arrivalTime }}</td>
                    <td>{{ $command->departureTime }}</td>
                    <td>{{ $command->airline }}</td>
                    <td>{{ $command->class }}</td>
                    <td>{{ $command->subclass }}</td>
                    <td>
                        <form action="{{ route('commands.delete', ['id' => $command->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


</body>
</html>
