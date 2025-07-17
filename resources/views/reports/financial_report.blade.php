<h2>General Financial Report</h2>
<p>Date: {{ $date }}</p>

<table border="1" width="100%" style="text-align:right; direction:rtl;">
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
            <td>{{ $entry['salary'] }}</td>
            <td>{{ $entry['amount'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p><strong>Total Paid:</strong> {{ $total_paid }} SYP</p>
