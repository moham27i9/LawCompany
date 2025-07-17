<h2>Jobs and Applicants Report</h2>
<p>Date: {{ $date }}</p>

<table border="1" width="100%" style="direction: rtl; text-align: right;">
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
