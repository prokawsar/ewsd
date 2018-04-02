<p>Hello Coordinator, </p>

<h3>You have a new Idea Submission.</h3>
<p>Student Name: {{ $user->name }} </p>
<p>Idea: {{ $idea->idea }} </p>
<p>Submitted on: {{ \Carbon\Carbon::today() }}</p>
<br>
<br>

<p>Thanks </p>
<p>Idea Finder </p>