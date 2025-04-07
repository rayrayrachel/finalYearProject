<div class="statistics">
    <div class="stat-card" wire:click="$dispatch('toggleSection', 'jobs')">
        <h3>Jobs Posted</h3>
        <p>{{ $jobCount }}</p>
    </div>
    <div class="stat-card" wire:click="$dispatch('toggleSection', 'comments')">
        <h3>Comments Received</h3>
        <p>{{ $commentCount }}</p>
    </div>
</div>
