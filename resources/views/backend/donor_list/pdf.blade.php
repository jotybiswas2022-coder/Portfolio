<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Donor List</title>
    <style>
        @page { margin: 20px 30px; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #333;
            padding: 0;
            margin: 0;
        }
        .header {
            text-align: center;
            padding: 20px 0 15px;
            border-bottom: 3px solid #dc3545;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            color: #dc3545;
            font-weight: 800;
        }
        .header p {
            margin: 4px 0 0;
            font-size: 11px;
            color: #888;
        }
        .header .drop {
            font-size: 28px;
            color: #dc3545;
            display: block;
            margin-bottom: 4px;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 18px;
            padding: 10px 14px;
            background: #f8f9fa;
            border-radius: 8px;
            font-size: 10px;
            color: #666;
        }
        .summary strong { color: #333; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th {
            background: linear-gradient(135deg, #dc3545, #e35e6f);
            color: #fff;
            padding: 9px 8px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
        }
        th:first-child { border-radius: 6px 0 0 0; }
        th:last-child { border-radius: 0 6px 0 0; }
        td {
            padding: 7px 8px;
            border-bottom: 1px solid #eee;
            font-size: 10px;
            color: #444;
        }
        tr:nth-child(even) td {
            background: #fafafa;
        }
        tr:last-child td:first-child { border-radius: 0 0 0 6px; }
        tr:last-child td:last-child { border-radius: 0 0 6px 0; }
        .blood-badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 50px;
            font-size: 9px;
            font-weight: 700;
            color: #fff;
        }
        .status-eligible {
            color: #16a34a;
            font-weight: 700;
            font-size: 9px;
        }
        .status-noteligible {
            color: #dc2626;
            font-weight: 600;
            font-size: 9px;
        }
        .footer {
            text-align: center;
            padding-top: 14px;
            font-size: 9px;
            color: #aaa;
            border-top: 1px solid #eee;
            margin-top: 14px;
        }
        .footer strong { color: #dc3545; }
    </style>
</head>
<body>
    <div class="header">
        <span class="drop">🩸</span>
        <h1>Blood Bank - Donor List</h1>
        <p>Generated on {{ now()->timezone('Asia/Dhaka')->format('d F Y, h:i A') }}</p>
    </div>

    <div class="summary">
        <span>Total Donors: <strong>{{ $donors->count() }}</strong></span>
        <span>Blood Groups: <strong>A+, A-, B+, B-, O+, O-, AB+, AB-</strong></span>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:30px;">#</th>
                <th>Name</th>
                <th>Phone</th>
                <th style="width:70px;text-align:center;">Blood</th>
                <th>Division</th>
                <th>Last Donation</th>
                <th style="width:75px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $bloodColors = [
                    'A+' => '#dc3545', 'A-' => '#e35e6f',
                    'B+' => '#0d6efd', 'B-' => '#5a9bf5',
                    'AB+'=> '#6f42c1', 'AB-'=> '#9b72cf',
                    'O+' => '#198754', 'O-' => '#4caf7d',
                ];
            @endphp
            @forelse($donors as $index => $donor)
            <tr>
                <td style="text-align:center;color:#aaa;">{{ $index + 1 }}</td>
                <td><strong>{{ $donor->name ?? 'N/A' }}</strong></td>
                <td>{{ $donor->number ?? 'N/A' }}</td>
                <td style="text-align:center;">
                    <span class="blood-badge" style="background:{{ $bloodColors[$donor->blood] ?? '#dc3545' }};">
                        {{ $donor->blood ?? 'N/A' }}
                    </span>
                </td>
                <td>{{ $donor->division ?? 'N/A' }}</td>
                <td>{{ $donor->last_donated ? $donor->last_donated->format('d M Y') : 'N/A' }}</td>
                <td>
                    @if($donor->canDonateNow())
                        <span class="status-eligible">✓ Eligible</span>
                    @else
                        <span class="status-noteligible">✗ {{ $donor->daysUntilNextDonation() }} days</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;padding:40px 0;color:#aaa;">No donors found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <strong>Blood Bank</strong> &mdash; Donor List Export &bull; {{ now()->format('Y') }}
    </div>
</body>
</html>
