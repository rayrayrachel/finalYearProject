<h1>New Application Received</h1>
<p><strong>Applicant:</strong> {{ $application->user->name }}</p>
<p><strong>Job Title:</strong> {{ $application->job->title }}</p>
<p><strong>Submitted At:</strong> {{ $application->created_at->toDayDateTimeString() }}</p>
<p>Login to accept the application; to view applicant's contact info and schedule a meeting.</p>
