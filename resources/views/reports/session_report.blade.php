@extends('layouts.report')

@section('title', 'Report For Session')

@section('content')

<h2>Report For Session {{ $session_id }}</h2>

<p><strong>Lawyer Name:</strong> {{ $lawyer_name }}</p>
<p><strong> Session Type:</strong> {{ $type }}</p>
<p><strong> Issue Name:</strong> {{ $issue_name }}</p>
<p><strong> Session Outcome :</strong> {{ $outcome }}</p>
<p><strong> Session Date:</strong> {{ $date }}</p>
<p><strong> Documents Number:</strong> {{ $documents_count }}</p>
@endsection
