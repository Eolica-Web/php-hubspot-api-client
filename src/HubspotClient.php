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

final readonly class HubspotClient
{
    private function __construct(private Transporter $transporter) {}

    public static function create(string $accessToken, ?ClientInterface $client = null): self
    {
        $transporter = new Transporter(new HttpMethodsClient(
            new PluginClient($client ?? Psr18ClientDiscovery::find(), [
                new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.hubapi.com')),
                new AuthenticationPlugin(new Bearer($accessToken)),
                new ContentTypePlugin(),
                new HeaderDefaultsPlugin([
                    'User-Agent' => 'eolica-php-hubspot-api-client/1.0.0 (https://github.com/Eolica-Web/php-hubspot-api-client)',
                ]),
                new RedirectPlugin(),
            ]),
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory(),
        ));

        return new self($transporter);
    }

    public function crm(): Api\Crm
    {
        return new Api\Crm($this->transporter);
    }

    public function cms(): Api\Cms
    {
        return new Api\Cms($this->transporter);
    }

    public function communicationPreferences(): Api\CommunicationPreferences
    {
        return new Api\CommunicationPreferences($this->transporter);
    }

    public function marketing(): Api\Marketing
    {
        return new Api\Marketing($this->transporter);
    }
}
