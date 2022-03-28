<div class="mt-2">
    <a id="action-{{ $action->id }}"></a>
    @switch($action->job)
        @case(\App\Domains\Actions\Jobs\AccessJob::class)
        <livewire:admin.action.access :action="$action"/>
        @break
        @case(\App\Domains\Actions\Jobs\InvoiceJob::class)
        <livewire:admin.action.invoice :action="$action"/>
        @break
        @case(\App\Domains\Actions\Jobs\BaselinkerJob::class)
        <livewire:admin.action.baselinker :action="$action"/>
        @break
        @case(\App\Domains\Actions\Jobs\MailerliteJob::class)
        <livewire:admin.action.mailerlite :action="$action"/>
        @break
    @endswitch
</div>
