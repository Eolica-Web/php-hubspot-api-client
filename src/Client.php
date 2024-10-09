<?php

declare(strict_types=1);

namespace Eolica\Hubspot;

use Eolica\Hubspot\Http\Transporter;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\ContentTypePlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Client\Common\PluginClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Message\Authentication\Bearer;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

final readonly class Client
{
    private Transporter $transporter;

    public function __construct(
        string $accessToken,
        ?ClientInterface $client = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
    ) {
        $this->transporter = new Transporter(new HttpMethodsClient(
            new PluginClient($client ?? Psr18ClientDiscovery::find(), [
                new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.hubapi.com')),
                new AuthenticationPlugin(new Bearer($accessToken)),
                new ContentTypePlugin(),
                new HeaderDefaultsPlugin([
                    'User-Agent' => 'eolica-php-hubspot-api-client/1.0.0 (https://github.com/Eolica-Web/php-hubspot-api-client)',
                ]),
                new RedirectPlugin(),
            ]),
            $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory(),
            $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory(),
        ));
    }

    public function deals(): Resources\Deals
    {
        return new Resources\Deals($this->transporter);
    }

    public function objects(string $type): Resources\Objects
    {
        return new Resources\Objects($type, $this->transporter);
    }

    public function owners(): Resources\Owners
    {
        return new Resources\Owners($this->transporter);
    }
}
