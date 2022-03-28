<div class="mt-2">
    @switch($action->job)
        @case(\App\Domains\Actions\Jobs\AccessJob::class)
        <livewire:admin.action.access :action="$action"/>
        @break
        @case(\App\Domains\Actions\Jobs\InvoiceJob::class)
        <livewire:admin.action.invoice :action="$action"/>
        @break
    @endswitch
</div>
