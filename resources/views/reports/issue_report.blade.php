<h2>Case Report: {{ $issue_title }}</h2>

<p><strong>Case Owner:</strong> {{ $owner_name }}</p>
<p><strong>Total Cost:</strong> {{ $total_cost }} SYP</p>
<p><strong>Amount Paid:</strong> {{ $amount_paid }} SYP</p>
<p><strong>Remaining Amount:</strong> {{ $remaining }} SYP</p>

<h3>Assigned Lawyers:</h3>
<ul>
    @foreach($lawyers as $lawyer)
        <li>{{ $lawyer }}</li>
    @endforeach
</ul>

<h3>Sessions:</h3>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>Session Number</th>
            <th>Lawyer Name </th>
            <th>Date</th>
            <th>Type</th>
            <th>Outcome</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sessions as $session)
            <tr>
                <td>{{ $session['session_number'] }}</td>
                <td>{{ $session['lawyer_name'] }}</td>
                <td>{{ $session['date'] }}</td>
                <td>{{ $session['type'] }}</td>
                <td>{{ $session['outcome'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
