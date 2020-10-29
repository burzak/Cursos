<?php

namespace Cursos;

final class ContainerFactory {

    /**
     * @return \Psr\Container\ContainerInterface
     */
    public static function create() {
        $containerBuilder = new \DI\ContainerBuilder();
        $containerBuilder->addDefinitions(dirname(__FILE__).'/../config/globalconfig.php');
        $container = $containerBuilder->build();
        return $container;
    }

}