<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Year Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #prime-year-table {
            visibility: hidden;
        }
        .visible-important {
            visibility: visible !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Add Year</h2>
        <div id="info-box" class="alert alert-secondary">
            <b>Info:</b><br>
            Thirty prime years counted backward from the entered year will be stored in the database.<br>
            Each entry includes the day of the week on which Christmas fell during that prime year, encrypted for security.
        </div>
        <div id="alert-container"></div>
        <form id="prime-year-form" method="POST">
            @csrf
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" class="form-control" id="year" name="year" value="1900" required min="1900">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <div id="prime-year-table" class="mt-4">
            <h3>Prime Years</h3>
            <table id="prime-years-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Christmas Day</th>
                    </tr>
                </thead>
                <tbody id="prime-year-body">
                    @foreach($primeYears as $primeYear)
                        <tr>
                            <td>{{ $primeYear['year'] }}</td>
                            <td>{{ $primeYear['day'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#prime-year-form').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize(); 
                var url = "{{ route('primeyear.store') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    dataType: 'json', 
                    success: function(response) {
                        $('#info-box').css('display', 'none');
                        $('#alert-container').html('<div class="alert alert-success">'+ response.message +'</div>');

                        $('#prime-year-body').empty();

                        $('#prime-year-table').addClass('visible-important');

                        $.each(response.primeYears, function(index, primeYear) {
                            $('#prime-year-body').append('<tr><td>'+ primeYear.year +'</td><td>'+ primeYear.day +'</td></tr>');
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '<div class="alert alert-danger"><ul>';

                        $.each(errors, function(key, value) {
                            errorMessage += '<li>' + value + '</li>';
                        });

                        errorMessage += '</ul></div>';
                        $('#alert-container').html(errorMessage);
                    }
                });
            });
        });
    </script>
</body>
</html>
