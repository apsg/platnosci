<?php
namespace App\Domains\Invoices;

enum ExemptionReasonEnum: int
{
    const REASONS = [
        0 => 'Brak',
        1 => 'Zwolnienie ze względu na rodzaj prowadzonej działalności (art. 43 ust. 1 pkt 26 ustawy o VAT)',
        2 => 'Zwolnienie ze względu na nieprzekroczenie limitu obrotu (art. 113 ust. 1 i 9 ustawy o VAT)',
    ];

    public static function toArray(): array
    {
        $cases = self::cases();

        $casesArray = [];
        /** @var ExemptionReasonEnum $case */
        foreach ($cases as $case) {
            $casesArray[$case->value] = $case->reasonDescription();
        }

        return $casesArray;
    }

    case NONE = 0;
    case TYPE = 1; // Zwolnienie ze względu na rodzaj prowadzonej działalności ( art. 43 ust. 1 pkt 26 ustawy o VAT )
    case LIMIT = 2; // Zwolnienie ze względu na nieprzekroczenie limitu obrotu ( art. 113 ust. 1 i 9 ustawy o VAT )

    public function reasonDescription(): string
    {
        return self::REASONS[$this->value];
    }
}
