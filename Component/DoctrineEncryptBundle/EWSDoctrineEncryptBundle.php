<?php

namespace EWS\Component\DoctrineEncryptBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use EWS\Component\DoctrineEncryptBundle\DependencyInjection\EWSDoctrineEncryptExtension;
use EWS\Component\DoctrineEncryptBundle\DependencyInjection\Compiler\RegisterServiceCompilerPass;


class EWSDoctrineEncryptBundle extends Bundle {
    
    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->addCompilerPass(new RegisterServiceCompilerPass(), PassConfig::TYPE_AFTER_REMOVING);
    }
    
    public function getContainerExtension()
    {
        return new EWSDoctrineEncryptExtension();
    }
}
