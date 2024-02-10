<?php
namespace App;

class Images
{
    const LOGOS = [
        'platnosci.local' => '/images/logo_inauka.svg',
        'platnosci.inauka.pl' => '/images/logo_inauka.svg',
        'exceledukacja.local' => '/images/logo_inauka.svg',
        'exceledukacja.pl' => '/images/logo_inauka.svg',
    ];

    const PAYMENTS = [
        'platnosci.local' => '/images/platnosci_inauka.png',
        'platnosci.inauka.pl' => '/images/platnosci_inauka.png',
        'exceledukacja.local' => '/images/platnosci_inauka.png',
        'exceledukacja.pl' => '/images/platnosci_inauka.png',
    ];

    public static function logo(): string
    {
        return static::LOGOS[static::detectSite()];
    }

    public static function payment(): string
    {
        return static::PAYMENTS[static::detectSite()];
    }

    public static function detectSite(): string
    {
        return request()->getHost();
    }
}
