<?php

namespace Core\UI;

use Core\Framework\Settings;
use Override;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class CoreUiBundle extends AbstractBundle
{

    #[Override]
    public function getPath() : string
    {
        return \dirname( __DIR__ );
    }
    /**
     * @param array<array-key, mixed> $config
     * @param ContainerConfigurator   $container
     * @param ContainerBuilder        $builder
     *
     * @return void
     */
    #[Override]
    public function loadExtension(
            array                 $config,
            ContainerConfigurator $container,
            ContainerBuilder      $builder,
    ) : void {
        \array_map( [$container, 'import'], $this->config() );
    }

    /**
     * @return array<int, string>
     */
    private function config() : array
    {
        return \glob( \dirname( __DIR__ ).'/config/ui/*.php' ) ?: [];
    }
}
