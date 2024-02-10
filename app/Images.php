<?php
namespace App;

class Images
{
    const LOGOS = [
        'platnosci.local' => '/images/logo_inauka.svg',
        'platnosci.inauka.pl' => '/images/logo_inauka.svg',
        'exceledukacja.local' => '/images/png-edukacja.png',
        'exceledukacja.pl' => '/images/png-edukacja.png',
    ];
    
    public static function logo(): string
    {
        return static::LOGOS[static::detectSite()];
    }

    public static function detectSite(): string
    {
        return request()->getHost();
    }
}
