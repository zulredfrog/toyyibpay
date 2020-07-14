<?php

namespace AimanDaniel\ToyyibPay;

use Laravie\Codex\Discovery;
use Http\Client\Common\HttpMethodsClient as HttpClient;

class Client extends \Laravie\Codex\Client
{
    /**
     * ToyyibPay API Key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * ToyyibPay API endpoint.
     *
     * @var string
     */
    protected $apiEndpoint = 'https://www.toyyibpay.com/index.php/api';

    /**
     * Default API version.
     *
     * @var string
     */
    protected $defaultVersion = 'v1';

    /**
     * List of supported API versions.
     *
     * @var array
     */
    protected $supportedVersions = [
        'v1' => 'One',
    ];

    /**
     * Construct a new Billplz Client.
     */
    public function __construct(HttpClient $http, string $apiKey)
    {
        $this->http = $http;

        $this->setApiKey($apiKey);
    }

    /**
     * Make a client.
     *
     * @return $this
     */
    public static function make(string $apiKey)
    {
        return new static(Discovery::client(), $apiKey);
    }

    /**
     * Use sandbox environment.
     *
     * @return $this
     */
    final public function useSandbox(): self
    {
        return $this->useCustomApiEndpoint('https://dev.toyyibpay.com/index.php/api');
    }

    /**
     * Get API Key.
     */
    final public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Set API Key.
     *
     * @return $this
     */
    final public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get Bank resource
     *
     * @param string|null $version
     * @return \AimanDaniel\ToyyibPay\Contracts\Bank
     */
    final public function bank(?string $version = null): Contracts\Bank
    {
        return $this->uses('Bank', $version);
    }

    /**
     * Get Bill resource
     *
     * @param string|null $version
     * @return \AimanDaniel\ToyyibPay\Contracts\Bill
     */
    final public function bill(?string $version = null): Contracts\Bill
    {
        return $this->uses('Bill', $version);
    }

    /**
     * Get User resource
     *
     * @param string|null $version
     * @return \AimanDaniel\ToyyibPay\Contracts\User
     */
    final public function user(?string $version = null): Contracts\User
    {
        return $this->uses('User', $version);
    }

    /**
     * Get Category resource
     *
     * @param string|null $version
     * @return \AimanDaniel\ToyyibPay\Contracts\Category
     */
    final public function category(?string $version = null): Contracts\Category
    {
        return $this->uses('Category', $version);
    }

    /**
     * Get resource default namespace.
     */
    final protected function getResourceNamespace(): string
    {
        return __NAMESPACE__;
    }
}