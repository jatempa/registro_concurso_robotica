<?php

$manager = $this->getContainer()->get('h4cc_alice_fixtures.manager');

// Get a FixtureSet with __default__ options.
$set = $manager->createFixtureSet();
$set->addFile(__DIR__.'/Usuarios.yml', 'yaml');
$set->addFile(__DIR__.'/Carreras.yml', 'yaml');
$set->addFile(__DIR__.'/Asesores.yml', 'yaml');
$set->addFile(__DIR__.'/Alumnos.yml', 'yaml');
$set->addFile(__DIR__.'/Robots.yml', 'yaml');
$set->addFile(__DIR__.'/Equipos.yml', 'yaml');

return $set;