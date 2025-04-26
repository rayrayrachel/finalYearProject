    <h1>Application Submitted Successfully</h1>
    <p>Dear {{ $application->user->name }},</p>
    <p>Thank you for submitting your application for the position of "{{ $application->job->title }}" at
        "{{ $application->job->user->name }}". We have received your application and will notify
        {{ $application->job->user->name }} .
    </p>
    <p>The company will only be able to view your contact when they accept your application.</p>
    <p>You will be notified when the application status changes.</p>

    <p>Best regards,<br>AI Job Hunter</p>
