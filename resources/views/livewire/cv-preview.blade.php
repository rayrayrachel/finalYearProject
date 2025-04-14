<div class="cv-container">
    <div class="cv-header">
        <div>
            <h2 class="cv-title">CV Preview</h2>
            <p class="cv-meta"><strong>Created:</strong> {{ $cv->created_at->format('F j, Y H:i') }}</p>
        </div>
        <button onclick="window.print()" class="editing-button">PRINT</button>
    </div>

    <div id="cv-print-area" class="bg-white">
        <div class="page-container">
            <div class="cv-sections">
                <!-- Contact -->
                <h2 class="highlighted-header-navy">{{ $cv->contact_information['name'] ?? 'N/A' }}‘s Curriculum Vitae
                </h2>

                <div class="element-container-cv">
                    <div class="grid grid-cols-2 gap-y-1">
                        <p><strong>Name:</strong> {{ $cv->contact_information['name'] ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $cv->contact_information['email'] ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $cv->contact_information['phone'] ?? 'N/A' }}</p>
                        <p><strong>Location:</strong> {{ $cv->contact_information['location'] ?? 'N/A' }}</p>
                        <p><strong>Date of Birth:</strong> {{ $cv->contact_information['date_of_birth'] ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="page-container">

                    <!-- Statement -->
                    @if (!empty($cv->personal_statement) && count($cv->personal_statement) > 0)
                        <div>
                            <h3 class="cv-section-heading">Personal Statement</h3>
                            <p>{{ $cv->personal_statement['statement'] ?? 'N/A' }}</p>
                        </div>
                    @endif

                    <!-- Experience -->
                    @if (!empty($cv->professional_experiences) && count($cv->professional_experiences) > 0)
                        <div>
                            <h3 class="cv-section-heading">Professional Experiences</h3>
                            <div class="space-y-4">
                                @foreach (collect($cv->professional_experiences)->sortByDesc(fn($exp) => $exp['end_date'] ?? now()->format('Y-m-d')) as $experience)
                                    <div class="rounded pb-4 border-b border-gray-300">
                                        <h4 class="cv-sub-heading"><strong>{{ $experience['job_title'] }}</strong>
                                            at
                                            <strong> {{ $experience['company_name'] }}</strong>
                                        </h4>
                                        <p class="cv-sub-meta">
                                            <span>{{ $experience['start_date'] }} -
                                                {{ $experience['end_date'] ?? 'Present' }}</span>
                                            <span class="ml-4"><strong>Location:</strong>
                                                {{ $experience['location'] }}</span>
                                        </p>
                                        <p><strong>Achievements:</strong> {{ $experience['key_achievements'] }}</p>
                                        <p><strong>Results:</strong> {{ $experience['quantifiable_results'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Education -->
                    @if (!empty($cv->educations) && count($cv->educations) > 0)
                        <div>
                            <h3 class="cv-section-heading">Education</h3>
                            <div class="cv-section-box">
                                @foreach (collect($cv->educations)->sortByDesc('graduation_date') as $education)
                                    <div class="cv-entry rounded pb-4 border-b border-gray-300">
                                        <h4 class="cv-sub-heading"><strong>{{ $education['degree'] }} </strong> in
                                            <strong>{{ $education['field_of_study'] }}</strong> at
                                            <strong>{{ $education['university_name'] }}</strong>
                                        </h4>
                                        <p class="cv-sub-meta"> {{ $education['start_date'] }} -
                                            {{ $education['graduation_date' ?? 'Present'] }}</p>
                                        @if (!empty($education['grade']))
                                            <p><strong>Grade:</strong> {{ $education['grade'] }}</p>
                                        @endif

                                        @if (!empty($education['project']))
                                            <p><strong>Projects:</strong> {{ $education['project'] }}</p>
                                        @endif

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Skills -->
                    @if (!empty($cv->skills) && count($cv->skills) > 0)
                        <div>
                            <h3 class="cv-section-heading">Skills</h3>
                            <ul class="list-disc list-inside space-y-1 pl-2">
                                @foreach ($cv->skills as $skill)
                                    <li>{{ $skill['skills'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Certifications -->
                    @if (!empty($cv->certifications) && count($cv->certifications) > 0)
                        <div>
                            <h3 class="cv-section-heading">Certifications & More</h3>
                            @php $cert = $cv->certifications; @endphp
                            <div class="grid grid-cols-2 gap-y-1">
                                @if (!empty($cert['languages_spoken']))
                                    <p><strong>Languages:</strong> {{ $cert['languages_spoken'] }}</p>
                                @endif
                                @if (!empty($cert['certifications']))
                                    <p><strong>Certifications:</strong> {{ $cert['certifications'] }}</p>
                                @endif
                                @if (!empty($cert['awards']))
                                    <p><strong>Awards:</strong> {{ $cert['awards'] }}</p>
                                @endif
                                @if (!empty($cert['publications']))
                                    <p><strong>Publications:</strong> {{ $cert['publications'] }}</p>
                                @endif
                                @if (!empty($cert['presentations']))
                                    <p><strong>Presentations:</strong> {{ $cert['presentations'] }}</p>
                                @endif
                                @if (!empty($cert['relevant_activities']))
                                    <p><strong>Activities:</strong> {{ $cert['relevant_activities'] }}</p>
                                @endif
                                @if (!empty($cert['hobbies_and_interests']))
                                    <p><strong>Hobbies:</strong> {{ $cert['hobbies_and_interests'] }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
