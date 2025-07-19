@extends('layouts.report')

@section('title', 'Jobs and Applicants Report')

@section('content')

    <h2>Jobs and Applicants Report</h2>
    <p><strong>Date:</strong> {{ $date }}</p>

    <table style="direction: rtl; text-align: right;">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Publish Date</th>
                <th>Number of Applicants</th>
                <th>Number of Accepted</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
                <tr>
                    <td>{{ $entry['job_title'] }}</td>
                    <td>{{ $entry['published_at'] }}</td>
                    <td>{{ $entry['applicants'] }}</td>
                    <td>{{ $entry['accepted'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
