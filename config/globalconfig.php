<?php

return array(
    'template_folder' => dirname(__FILE__).'/../templates/',
    'db_file' => dirname(__FILE__).'/prod.dump',
    'test_db_file' => dirname(__FILE__).'/test.dump',
    'Twig\Loader\LoaderInterface' =>
            \DI\autowire('Twig\Loader\FilesystemLoader')->constructor(\DI\get('template_folder')
    ),
    'Twig\Environment' => \DI\autowire(),

    'Cursos\DB\StorageInterface' => \DI\autowire('Cursos\DB\FileStorage')->constructor(\DI\get('db_file')),
    'Cursos\Templates\TemplateEngineInterface' => \DI\autowire('Cursos\Templates\TwigTemplateEngine'),
);