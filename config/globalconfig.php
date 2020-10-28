<?php

return array(
    'template_folder' => dirname(__FILE__).'/../templates/',
    'Twig\Loader\LoaderInterface' =>
            \DI\autowire('Twig\Loader\FilesystemLoader')->constructor(\DI\get('template_folder')
    ),
    'Twig\Environment' => \DI\autowire(),

    'Cursos\DB\StorageInterface' => \DI\autowire('Cursos\DB\MemoryStorage'),
    'Cursos\Templates\TemplateEngineInterface' => \DI\autowire('Cursos\Templates\TwigTemplateEngine'),
);