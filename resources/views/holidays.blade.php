<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holiday Import</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Import Holidays from Excel</h1>
                    </div>
                    <div class="card-body">
                        <form id="preImportForm" enctype="multipart/form-data">
                            <div class="input-group">
                                <input type="file" name="file" id="file" class="form-control" required>
                                <button type="button" id="preImportBtn" class="btn btn-primary">Preview Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <table id="previewTable" style="display:none;" class="table">
            <thead>
                <tr>
                    <th scope="col">Occasion</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <form id="importForm" enctype="multipart/form-data" style="display:none;">
            <input type="hidden" name="file" id="fileData">
            <button type="button" id="importBtn">Import Data</button>
        </form>

    </div>
    <script>
        // Preview Button Click
        $('#preImportBtn').click(function(e) {
            e.preventDefault();

            let formData = new FormData($('#preImportForm')[0]);
            let url = "{{route('holidays.preImport')}}";
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Show Preview Table
                    $('#previewTable').show();
                    let tableBody = $('#previewTable tbody');
                    tableBody.empty();

                    $.each(response, function(index, row) {
                        tableBody.append('<tr><td>' + row[0] + '</td><td>' + row[1] + '</td></tr>');
                    });

                    // Show Import Form
                    $('#importForm').show();
                    // Store file data for later import
                    $('#fileData').val($('#file')[0].files[0]);
                }
            });
        });

        // Import Button Click
        $('#importBtn').click(function(e) {
            e.preventDefault();

            let formData = new FormData($('#preImportForm')[0]);
            let url = "{{route('holidays.import')}}";
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.success);
                }
            });
        });
    </script>
</body>

</html>