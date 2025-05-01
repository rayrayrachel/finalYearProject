<div>
    @if ($score !== null)
        <div class="element-container">
            <h4 class="text-xl font-semibold mb-2 text-green-600">Match Score: {{ $score }}%</h4>

            <!-- Matched Important Keywords -->
            <div class="mb-4">
                <h5 class="font-medium text-gray-700">Matched Important Keywords:</h5>
                <ul class="flex flex-wrap gap-2 mt-2">
                    @foreach ($matchedImportantKeywords as $keyword)
                        <li class="keyword-badge">{{ $keyword }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Matched Less Important Keywords -->
            <div class="mb-4">
                <h5 class="font-medium text-gray-700">Matched Less Important Keywords:</h5>
                <ul class="flex flex-wrap gap-2 mt-2">
                    @foreach ($matchedLessImportantKeywords as $keyword)
                        <li class="keyword-badge">{{ $keyword }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Missed Important Keywords -->
            <div>
                <h5 class="font-medium text-gray-700">Missed Important Keywords:</h5>
                <ul class="flex flex-wrap gap-2 mt-2">
                    @foreach ($missedImportantKeywords as $keyword)
                        <li class="keyword-badge keyword-badge--missing">{{ $keyword }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Missed Less Important Keywords -->
            <div>
                <h5 class="font-medium text-gray-700">Missed Less Important Keywords:</h5>
                <ul class="flex flex-wrap gap-2 mt-2">
                    @foreach ($missedLessImportantKeywords as $keyword)
                        <li class="keyword-badge keyword-badge--missing">{{ $keyword }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert-error mt-4">
            {{ session('error') }}
        </div>
    @endif
</div>
