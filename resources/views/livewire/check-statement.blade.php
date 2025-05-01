<div>
    @if ($score !== null)
        <div class="element-container">
            <h4 class="text-xl font-semibold mb-2 text-green-600">LSTM Rating: {{ $goodPercentage }}%</h4>

            <h5 class="font-small text-gray-400">Rate: how constructive your input is comparing your cv component with
                the database using LSTM Model.</h5>


            <h5 class="font-medium text-gray-700"><strong>Constructive Sentences:</strong></h5>
            <ul>
                @foreach ($goodSentences as $sentence)
                    <li class="keyword-badge">{{ $sentence['sentence'] }} (Score: {{ $sentence['score'] }})</li>
                @endforeach
            </ul>

            <h5 class="font-medium text-gray-700"><strong>Not Constructive Sentences:</strong></h5>
            <ul>
                @foreach ($badSentences as $sentence)
                    <li class="keyword-badge keyword-badge--missing">{{ $sentence['sentence'] }} (Score:
                        {{ $sentence['score'] }})</li>
                @endforeach
            </ul>


        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert-error mt-4">
            {{ session('error') }}
        </div>
    @endif

</div>
