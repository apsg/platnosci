<?php
namespace App\Domains\Integrations\Access;

use App\Domains\Actions\Exceptions\InvalidProviderException;
use function config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AccessProvider
{
    const COURSE_LIST = '/api/courses';
    const ACCESS_URL = '/api/access';
    const HEADER_NAME = 'X-INAUKA-KEY';

    protected string $provider;

    protected string $baseUrl;

    public static function make(string $provider): static
    {
        if (config("integrations.access.providers.{$provider}") === null) {
            throw new InvalidProviderException($provider);
        }

        return new static($provider);
    }

    public function __construct(string $provider)
    {
        $this->provider = $provider;
        $this->baseUrl = config("integrations.access.providers.{$provider}.url");
    }

    public function courses(): array
    {
        return Cache::remember(Str::slug($this->baseUrl) . 'courses', 60, function () {
            return Http::baseUrl($this->baseUrl)
                ->get(static::COURSE_LIST)
                ->json('data');
        });
    }

    public function grantAccess(string $email, int $courseId): void
    {
        Http::baseUrl($this->baseUrl)
            ->withHeaders([
                static::HEADER_NAME => $this->getHeaderKey(),
            ])
            ->post(static::ACCESS_URL, [
                'email'     => $email,
                'course_id' => $courseId,
            ]);
    }

    protected function getHeaderKey(): string
    {
        return config("integrations.access.providers.{$this->provider}.key");
    }
}
