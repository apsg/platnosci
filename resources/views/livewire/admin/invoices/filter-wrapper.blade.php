<div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-4">
        <div class="flex items-center space-x-4">
            <label class="font-medium text-gray-700">Status faktury:</label>
            <select wire:model="showAccepted" class="form-select rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="0">Oczekujące</option>
                <option value="1">Zaakceptowane</option>
            </select>
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <livewire:admin.invoices.index :showAccepted="$showAccepted" :key="'invoices-'.$showAccepted" />
    </div>
</div>
