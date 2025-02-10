<?php
namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Models\JobPost;
use App\Http\Livewire\Handle;

new #[Layout('layouts.app')] class extends Component
{
    public string $title = '';
    public string $description = '';
    public string $requirements = '';
    public int $salary_from = 0;
    public int $salary_to = 0;

    public $user_id;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'requirements' => 'nullable|string',
        'salary_from' => 'required|numeric',
        'salary_to' => 'required|numeric',
    ];

    public function mount()
    {
        $this->user_id = Auth::id();
    }

    #[Handle('submit')]
    
    public function submit()
    {
        $this->validate();

        $salary_range = $this->salary_from . ' - ' . $this->salary_to;

        JobPost::create([
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'salary_range' => $salary_range,
        ]);

        session()->flash('message', 'Job posted successfully!');

        $this->reset(['title', 'description', 'requirements', 'salary_from', 'salary_to']);
    }

    public function render(): mixed
    {
        return view('livewire.create-job');
    }
}
?>

<div>
    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" wire:model="title" class="block mt-1 w-full" type="text" required />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" wire:model="description" class="block mt-1 w-full" required></textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="requirements" :value="__('Requirements')" />
            <textarea id="requirements" wire:model="requirements" class="block mt-1 w-full"></textarea>
            <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="salary_from" :value="__('Salary From')" />
            <select id="salary_from" wire:model="salary_from" class="block mt-1 w-full" required>
                <option value="">Select Salary From</option>
                @foreach (range(10000, 100000, 5000) as $amount)
                    <option value="{{ $amount }}">{{ number_format($amount) }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('salary_from')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="salary_to" :value="__('Salary To')" />
            <select id="salary_to" wire:model="salary_to" class="block mt-1 w-full" required>
                <option value="">Select Salary To</option>
                @foreach (range(15000, 120000, 5000) as $amount)
                    <option value="{{ $amount }}">{{ number_format($amount) }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('salary_to')" class="mt-2" />
        </div>

        <div class="x-primary-button flex items-center justify-end">
            <x-primary-button class="ml-4">
                {{ __('Post Job') }}
            </x-primary-button>
        </div>
    </form>
</div>
