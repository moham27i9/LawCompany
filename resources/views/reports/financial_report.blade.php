@extends('layouts.report')

@section('title', 'General Financial Report')

@section('content')

    <h2>General Financial Report</h2>
    <p><strong>Date:</strong> {{ $date }}</p>

    <table style="direction: rtl;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Salary</th>
                 <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
                <tr>
                    <td>{{ $entry['lawyer_name'] ?? $entry['employee_name'] ?? '---' }}</td>
                       <td>{{ $entry['type'] === 'lawyer' ? 'Lawyer' : 'Employee' }}</td>
                    <td>{{ number_format($entry['salary'], 2) }}</td>
                    <td>{{ number_format($entry['amount'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total Paid:</strong> {{ number_format($total_paid, 2) }} ل.س</p>

@endsection
