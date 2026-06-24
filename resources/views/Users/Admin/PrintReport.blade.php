<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Report</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success">
            <h1>Print Report Page is Working!</h1>
            <p><strong>Filter Type:</strong> {{ $filterType ?? 'Not set' }}</p>
            <p><strong>Period:</strong> {{ $periodDisplay ?? 'Not set' }}</p>
            <p><strong>Total Transactions:</strong> {{ $transactions->count() ?? 0 }}</p>
        </div>

        <!-- Debug info -->
        <div class="card">
            <div class="card-body">
                <h5>Debug Information</h5>
                <pre>
                    Filter Type: {{ $filterType ?? 'N/A' }}
                    Period Display: {{ $periodDisplay ?? 'N/A' }}
                    Transaction Count: {{ $transactions->count() ?? 0 }}
                    All Data: {{ json_encode($transactions->toArray() ?? [], JSON_PRETTY_PRINT) }}
                </pre>
            </div>
        </div>

        <button onclick="window.print()" class="btn btn-primary">Print</button>
        <button onclick="window.close()" class="btn btn-secondary">Close</button>
    </div>
</body>
</html>
