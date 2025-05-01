<div>
    @if ($score !== null)
        <div class="element-container">
            <h3><strong>Good Sentences:</strong></h3>
            <ul>
                @foreach ($goodSentences as $sentence)
                    <li class="keyword-badge">{{ $sentence['sentence'] }} (Score: {{ $sentence['score'] }})</li>
                @endforeach
            </ul>

            <h5 class="font-medium text-gray-700"><strong>Bad Sentences:</strong></h5>
            <ul>
                @foreach ($badSentences as $sentence)
                    <li class="keyword-badge keyword-badge--missing">{{ $sentence['sentence'] }} (Score: {{ $sentence['score'] }})</li>
                @endforeach
            </ul>

            <h4 style="margin-top: 15px;"><strong>Good Percentage:</strong> {{ $goodPercentage }}%</h4>

            <h4><strong>Average Good Score:</strong> {{ $score }}</h4>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert-error mt-4">
            {{ session('error') }}
        </div>
    @endif

</div>
