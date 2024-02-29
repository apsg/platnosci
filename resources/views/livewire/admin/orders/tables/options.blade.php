<div>
    <a href="{{ route('admin.orders.resend', $id) }}" class="block mx-2 rounded p-2 border border-gray-200 hover:bg-indigo-200">
        <x-icon name="refresh" class="w-5 h-5 inline"/>
        Wyślij ponownie email
    </a>
    <a href="{{ route('admin.actions.retry', $id) }}" class="block mx-2 rounded p-2 border border-gray-200 hover:bg-indigo-200">
        <x-icon name="refresh" class="w-5 h-5 inline"/>
        Wykonaj ponownie akcje
    </a>
</div>
