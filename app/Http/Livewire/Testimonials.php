<?php
namespace App\Http\Livewire;

use Illuminate\Support\Arr;
use Livewire\Component;

class Testimonials extends Component
{
    const TESTTIMONIALS = [
        [
            'letter' => 'P',
            'color'  => '#0517B8',
            'text'   => 'Dziękuje za bardzo interesujące i dokładnie przeprowadzone szkolenie. Bardzo dużo nowych i przydatnych informacji.',
            'name'   => 'Paweł K.',
        ],
        [
            'letter' => 'M',
            'color'  => '#F22B2B',
            'text'   => 'Idealne szkolenia dla osób początkujących i średnio zaawansowanych. Materiał zawsze na najwyższym poziomie! Stosunek jakości do ceny - wspaniały!',
            'name'   => 'Marcin W.',
        ],
        [
            'letter' => 'A',
            'color'  => '#FF8812',
            'text'   => 'Treściwa i praktyczna wiedza, którą można od razu zastosować. Polecam!',
            'name'   => 'Artur S.',
        ],
        [
            'letter' => 'E',
            'color'  => '#FF7600',
            'text'   => 'Jasno i przystępnie wytłumaczone, konferencje prowadzone z humorem, nie ma mowy o nudzie. Jak najbardziej polecam.',
            'name'   => 'Ewa K.',
        ],
        [
            'letter' => 'M',
            'color'  => '#00E092',
            'text'   => 'Fenomenalne materiały - cena promocyjna 150 zł a dostałem parę gb materiałów. Jestem w szoku!! Niezależnie od poziomu warto kupić!',
            'name'   => 'Maciej B.',
        ],
        [
            'letter' => 'A',
            'color'  => '#1BB3F4',
            'text'   => 'Bardzo zrozumiały sposób prowadzenia szkoleń, słuchając człowiek się nie nudzi, same przydatne informacje, sposoby, triki ułatwiające pracę 😉',
            'name'   => 'Aneta K.',
        ],
        [
            'letter' => 'P',
            'color'  => '#FFCE00',
            'text'   => 'Super porady. Polecam. Wszystko w bardzo przystępnej formie.',
            'name'   => 'Paweł M.',
        ],
        [
            'letter' => 'M',
            'color'  => '#A7E51A',
            'text'   => 'Szkolenia Excela prowadzone w bardzo przyjemny i zrozumiały sposób. Duży podział tematyczny. Każdy może znaleźć coś dla siebie.',
            'name'   => 'Marcin K.',
        ],
        [
            'letter' => 'M',
            'color'  => '#6618FA',
            'text'   => 'Bardzo fajne webinaria, kursy i materiały. Wszystko tłumaczone w sposób jasny i zrozumiały nawet dla osób, które dopiero zaczynają przygodę z excelem.',
            'name'   => 'Marcin T.',
        ],
        [
            'letter' => 'M',
            'color'  => '#FFA62E',
            'text'   => 'Bardzo praktyczne i pomocne triki i porady! Do tego mila i zabawna atmosfera!',
            'name'   => 'Grzegorz G.',
        ],
    ];

    public function render()
    {
        return view('livewire.testimonials')->with(Arr::random(static::TESTTIMONIALS));
    }
}
