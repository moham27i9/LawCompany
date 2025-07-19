@extends('layouts.report')

@section('title', 'Financial Payments Report for Cases')

@section('content')

    <h2>Financial Payments Report for Cases</h2>
    <p><strong>Date:</strong> {{ $date }}</p>

    <table style="direction: rtl; text-align: right;">
        <thead>
            <tr>
                <th>Case Title</th>
                <th>Client Name</th>
                <th>Total Cost</th>
                <th>Paid</th>
                <th>Remaining</th>
                <th>Number of Agreed Installments</th>
                <th>Last Payment Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
                <tr>
                    <td>{{ $entry['issue_title'] }}</td>
                    <td>{{ $entry['client_name'] }}</td>
                    <td>{{ $entry['total_cost'] }}</td>
                    <td>{{ $entry['paid'] }}</td>
                    <td>{{ $entry['remaining'] }}</td>
                    <td>{{ $entry['installments'] }}</td>
                    <td>{{ $entry['last_payment'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
