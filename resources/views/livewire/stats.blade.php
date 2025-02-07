<div>
    @if($days > 0)
    <h3 class="text-lg font-bold border-b-2 mt-3">Statystyki dla ostatnich {{ $days }} dni</h3>
    @else
        <h3 class="text-lg font-bold border-b-2 mt-3">Statystyki dzisiaj od początku dnia (00:00)</h3>
    @endif

    <div>
        Liczba sprzedaży: <span class="font-bold text-green-700">{{ $stats['total']->c }}</span>
        na kwotę: <span class="font-bold text-green-700">{{ $stats['total']->sum }} PLN</span>
    </div>
    <div>
        <table class="table-auto mt-3">
            <thead>
            <tr>
                <th>Nazwa</th>
                <th>Sprzedaży</th>
                <th>Kwota</th>
            </tr>
            </thead>
            <tbody>

            @foreach($stats['grouped'] as $sale)
            <tr>
                <td class="p-2">{{ $sale->name }}</td>
                <td class="text-center">{{ $sale->c }}</td>
                <td>{{ $sale->sum }} PLN</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
