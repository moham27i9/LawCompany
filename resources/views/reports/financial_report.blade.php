<h2>Financial Report</h2>
<p>Date: {{ $date }}</p>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>Lawyer Name </th>
            <th>Issue Title</th>
            <th>Total Points</th>
            <th> Salary</th>
            <th> Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($entries as $entry)
        <tr>
            <td>{{ $entry['lawyer_name'] }}</td>
            <td>{{ $entry['issue_title'] }}</td>
            <td>{{ $entry['total_points'] }}</td>
            <td>{{ $entry['salary'] }}</td>
            <td>{{ $entry['amount'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p><strong> Total Paid:</strong> {{ $total_paid }} L.s</p>

<style>
    @font-face {
        font-family: 'Cairo';
        src: url('{{ public_path('fonts/Cairo.ttf') }}') format('truetype');
    }

    body {
        font-family: 'Cairo', sans-serif;
        direction: rtl;
        text-align: right;

    }

    table {
        font-family: 'Cairo', sans-serif;
    }
</style>
<body style="direction: rtl; text-align: right;">
