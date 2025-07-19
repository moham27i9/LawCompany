@extends('layouts.report')

@section('title', 'Lawyer Sessions Report')

@section('content')

<h2>Lawyer Sessions Report</h2>
<p><strong>Period:</strong> From {{ $from }} To {{ $to }}</p>
<style>
    table, th, td {
    font-size: 13px; 
    padding: 4px;
}
</style>
<table>
    <thead>
        <tr>
            <th>Session Number</th>
            <th>Issue Number</th>
            <th>Issue Title</th>
            <th>Status</th>
            <th>Session Type</th>
            <th>Outcome</th>
            <th>Attended</th>
            <th>Points</th>
            <th>Future Appointments</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $r)
            <tr>
                <td>{{ $r['session_id'] }}</td>
                <td>{{ $r['issue_number'] }}</td>
                <td>{{ $r['issue_title'] }}</td>
                <td>{{ $r['issue_status'] }}</td>
                <td>{{ $r['session_type'] }}</td>
                <td>{{ $r['outcome'] }}</td>
                <td>{{ $r['attended'] }}</td>
                <td>{{ $r['points'] }}</td>
                <td>{{ $r['future_appointments'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
