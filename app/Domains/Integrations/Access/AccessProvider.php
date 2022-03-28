<?php
namespace App\Domains\Integrations\Access;

use App\Domains\Actions\Exceptions\InvalidProviderException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use function config;

class AccessProvider
{
    const COURSE_LIST = '/api/courses';

    protected string $baseUrl;

    public static function make(string $provider) : static
    {
        if (config("integrations.access.providers.{$provider}") === null) {
            throw new InvalidProviderException($provider);
        }

        return new static(config("integrations.access.providers.{$provider}.url"));
    }

    public function __construct(string $url)
    {
        $this->baseUrl = $url;
    }

    public function courses() : array
    {
        return Cache::remember(Str::slug($this->baseUrl) . 'courses', 60, function () {
            return Http::baseUrl($this->baseUrl)
                ->get(static::COURSE_LIST)
                ->json('data');
        });
    }
}
