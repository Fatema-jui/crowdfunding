<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f0fdf4; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .card { background: white; border-radius: 16px; padding: 2.5rem 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08); max-width: 420px; width: 90%; }
        .icon { width: 72px; height: 72px; border-radius: 50%; background: #f0fdf4; border: 1px solid #bbf7d0; display: flex; justify-content: center; align-items: center; margin: 0 auto 1.25rem; }
        h1 { font-size: 20px; font-weight: 600; color: #15803d; margin-bottom: 6px; }
        .subtitle { font-size: 14px; color: #6b7280; margin-bottom: 1.75rem; }
        .info-box { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 10px; padding: 1rem; margin-bottom: 1.5rem; text-align: left; }
        .row { display: flex; justify-content: space-between; align-items: center; padding: 7px 0; font-size: 13px; border-bottom: 1px solid #f3f4f6; }
        .row:last-child { border-bottom: none; }
        .row .label { color: #6b7280; }
        .row .value { font-weight: 500; color: #111827; }
        .badge { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; padding: 2px 10px; border-radius: 6px; font-size: 12px; font-weight: 500; }
        .buttons { display: flex; gap: 10px; }
        .btn { flex: 1; padding: 10px; font-size: 13px; border-radius: 8px; cursor: pointer; font-weight: 500; text-decoration: none; text-align: center; }
        .btn-green { background: #22c55e; color: white; border: none; }
        .btn-green:hover { background: #16a34a; }
        .btn-outline { background: white; color: #374151; border: 1px solid #d1d5db; }
        .btn-outline:hover { background: #f9fafb; }
    </style>
</head>
<body>
    <div class="card">

        <div class="icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                 stroke="#22c55e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>

        <h1>Payment successful</h1>
        <p class="subtitle">Your donation has been successfully completed. Thank you!</p>

        <div class="info-box">
            @if(session('tran_id'))
            <div class="row">
                <span class="label">Transaction ID</span>
                <span class="value">{{ session('tran_id') }}</span>
            </div>
            @endif

            @if(session('amount'))
            <div class="row">
                <span class="label">Amount</span>
                <span class="value" style="color: #15803d;">৳ {{ session('amount') }}</span>
            </div>
            @endif

            <div class="row">
                <span class="label">Payment method</span>
                <span class="value">Online</span>
            </div>

            <div class="row">
                <span class="label">Status</span>
                <span class="badge">Completed</span>
            </div>
        </div>

        <div class="buttons">
            <a href="{{ route('website') }}" class="btn btn-green">Go to Home Page</a>
            <a href="{{ route('crisis.list') }}" class="btn btn-outline">See More</a>
        </div>

    </div>
</body>
</html>