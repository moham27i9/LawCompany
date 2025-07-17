<!doctype html>
<meta charset="utf-8">
<h3>Report Lawyer Sessions</h3>
<p>Period From:   {{ $from }} To:  {{ $to }}</p>
<table border="1" width="100%" cellpadding="5">
<thead>
<tr>
    <th>Session Number</th>
    <th>Issue Number</th>
    <th>Issue Title</th>
    <th>Status</th>
    <th>Session Type</th>
    <th>Outcome</th>
    <th>Attended</th>
    <th>Ponits</th>
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
