<?php
namespace App\Domains\Integrations\Access;

use App\Domains\Actions\Exceptions\InvalidProviderException;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AccessProvider
{
    const COURSE_LIST = '/api/courses';
    const ACCESS_URL = '/api/access';
    const HEADER_NAME = 'X-INAUKA-KEY';
    const CHECK_USER_URL = '/api/user';

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
        $this->request([
            'email'     => $email,
            'course_id' => $courseId,
        ]);
    }

    public function grantFullAccess(string $email): PromiseInterface|Response
    {
        return $this->request([
            'email'          => $email,
            'is_full_access' => true,
        ]);
    }

    public function grantFullLifetimeAccess(string $email)
    {
        return $this->request([
            'email'              => $email,
            'is_full_access'     => true,
            'is_lifetime_access' => true,
        ]);
    }

    public function checkUser(string $email): PromiseInterface|Response
    {

        return Http::baseUrl($this->baseUrl)
            ->withHeaders([
                static::HEADER_NAME => $this->getHeaderKey(),
            ])
            ->get(static::CHECK_USER_URL, ['email' => $email])
            ->onError(function (Response $error) use ($email) {
                Log::error(__CLASS__, [
                    'provider' => $this->provider,
                    'payload'  => $email,
                    'error'    => $error->json(),
                ]);
            });
    }

    protected function request(array $payload): PromiseInterface|Response
    {
        Log::info(__CLASS__, $payload);

        return Http::baseUrl($this->baseUrl)
            ->withHeaders([
                static::HEADER_NAME => $this->getHeaderKey(),
            ])
            ->post(static::ACCESS_URL, $payload)
            ->onError(function (Response $error) use ($payload) {
                Log::error(__CLASS__, [
                    'provider' => $this->provider,
                    'payload'  => $payload,
                    'error'    => $error->json(),
                ]);
            });
    }

    protected function getHeaderKey(): string
    {
        return config("integrations.access.providers.{$this->provider}.key");
    }
}
