@extends('layouts.report')

@section('title', 'User Report: ' . $user->name)

@section('content')

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
    @forelse($issues as $issue)
        <li>
            Title: {{ $issue->title }} |
            Number: {{ $issue->issue_number }} |
            Status: {{ $issue->status }} |
            Cost: {{ $issue->total_cost }} |
            Category: {{ $issue->category->name ?? '---' }}
        </li>
    @empty
        <li>No cases submitted.</li>
    @endforelse
</ul>

<hr>

<h3>Legal Consultations:</h3>
<ul>
    @forelse($consultations as $c)
        <li>
            <strong>Subject:</strong> {{ $c->subject }} |
            <strong>Details:</strong> {{ $c->details ?? '---' }} |
            <strong>Date:</strong> {{ $c->created_at->format('Y-m-d') }}
        </li>
    @empty
        <li>No consultations submitted.</li>
    @endforelse
</ul>

<hr>

<h3>Submitted Complaints:</h3>
<ul>
    @forelse($complaints as $comp)
        <li>
            Description: {{ $comp->description }} |
            Status: {{ $comp->status }} |
            {{ $comp->created_at->format('Y-m-d') }}
        </li>
    @empty
        <li>No complaints submitted.</li>
    @endforelse
</ul>

<hr>

<h3>Job Applications:</h3>
<ul>
    @forelse($job_applications as $job)
        <li>
            Status: {{ $job->status }} |
            Submission Date: {{ $job->created_at->format('Y-m-d') }}
        </li>
    @empty
        <li>No job applications submitted.</li>
    @endforelse
</ul>
@endsection
