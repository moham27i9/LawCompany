<h2>User Report: {{ $user->name }}</h2>
<p><strong>Name:</strong> {{ $user->name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<p><strong>Phone:</strong> {{ $profile->phone ?? '---' }}</p>
<p><strong>Age:</strong> {{ $profile->age ?? '---' }}</p>
<p><strong>Address:</strong> {{ $profile->address ?? '---' }}</p>
<p><strong>Educational Level:</strong> {{ $profile->scientificLevel ?? '---' }}</p>

<hr>
<h3>Submitted Cases:</h3>
<ul>
@foreach($issues as $issue)
    <li>
        <strong>{{ $issue->title }}</strong> | Number: {{ $issue->issue_number }} | Status: {{ $issue->status }}
        | Cost: {{ $issue->total_cost }} | Category: {{ $issue->category->name ?? '---' }}
    </li>
@endforeach
</ul>

<hr>
<h3>Legal Consultations:</h3>
<ul>
@foreach($consultations as $c)
    <li>
        <strong>| Subject :{{ $c->subject }}</strong>
        <strong> | Details : {{ $c->details ?? '---' }}</strong>
        <strong> |Date : {{ $c->created_at->format('Y-m-d') }}</strong>
    </li>
@endforeach
</ul>

<hr>
<h3>Submitted Complaints:</h3>
<ul>
@foreach($complaints as $comp)
    <li>
     Description: {{ $comp->description }} | Status: {{ $comp->status }} | {{ $comp->created_at->format('Y-m-d') }}
    </li>
@endforeach
</ul>

<hr>
<h3>Job Applications:</h3>
<ul>

@foreach($job_applications as $job)
    <li>
    | Status : {{ $job->status }} | Submission Date : {{ $job->created_at->format('Y-m-d') }}
    </li>
@endforeach
</ul>
