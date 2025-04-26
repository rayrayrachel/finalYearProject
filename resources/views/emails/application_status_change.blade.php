    <h1>Your Application Status Has Been Updated</h1>
    <p>Dear {{ $application->user->name }},</p>

    @if ($application->status === 'accepted')
        <p>We are pleased to inform you that your application for the position of
            "<strong>{{ $application->job->title }}</strong>" at
            "<strong>{{ $application->job->user->name }}</strong>" has been <strong>accepted</strong>.</p>
        <p>Congratulations! The company can view your contact information and will reach out to you soon to discuss the
            next steps.</p>
    @elseif($application->status === 'rejected')
        <p>We regret to inform you that your application for the position of
            "<strong>{{ $application->job->title }}</strong>" at
            "<strong>{{ $application->job->user->name }}</strong>" has been <strong>rejected</strong>.</p>
        <p>Thank you for your interest, and we encourage you to apply for future opportunities.</p>
    @endif

    <p>We wish you all the best in your future endeavors!</p>

    <p>Best regards,<br>AI Job Hunter</p>
