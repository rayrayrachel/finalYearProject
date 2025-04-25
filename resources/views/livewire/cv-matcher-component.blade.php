 <div>
     @if ($score !== null)
         <div class="p-4 bg-white rounded-lg shadow w-full max-w-full">
             <h4 class="text-xl font-semibold mb-2 text-green-600">Match Score: {{ $score }}%</h4>

             <div class="mb-4">
                 <h5 class="font-medium text-gray-700">Matched Keywords:</h5>
                 <ul class="flex flex-wrap gap-2 mt-2">
                     @foreach ($matchedKeywords as $keyword)
                         <li class="keyword-badge">{{ $keyword }}</li>
                     @endforeach
                 </ul>
             </div>

             <div>
                 <h5 class="font-medium text-gray-700">Missing Keywords:</h5>
                 <ul class="flex flex-wrap gap-2 mt-2">
                     @foreach (array_diff($totalKeywords, $matchedKeywords) as $keyword)
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
