<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CheckStatement extends Component
{
    public $score = null;

    public $paragraph;
    public $goodSentences = [];
    public $badSentences = [];
    public $goodPercentage = 0;
    public $allResults = [];

    protected $listeners = ['runStatementCheck'];

    public function runStatementCheck($paragraph)
    {
        
        $this->paragraph = $paragraph;
        $this->checkStatement();
    }

    public function checkStatement()
    {
        if (!$this->paragraph) {
            session()->flash('error', 'Please write a statement first.');
            return;
        }

        try {
            $response = Http::post('https://check-statement-api-ggffauf4byexc9a2.uksouth-01.azurewebsites.net/predict', [
                'paragraph' => $this->paragraph,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                $this->goodSentences = $data['good_sentences'] ?? [];
                $this->badSentences = $data['bad_sentences'] ?? [];
                $this->goodPercentage = $data['good_percentage'] ?? 0;
                $this->allResults = $data['all'] ?? [];

                $goodScores = collect($this->goodSentences)->pluck('score');
                $this->score = $goodScores->count() ? round($goodScores->avg(), 2) : 0;
            } else {
                session()->flash('error', 'API error: ' . $response->body());
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to connect to prediction API: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.check-statement');
    }
}
