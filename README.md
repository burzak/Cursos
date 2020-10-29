# Cursos

## Bajamos composer

Acá estan las instrucciones (https://getcomposer.org/download/)

    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'c31c1e292ad7be5f49291169c0ac8f683499edddcfd4e42232982d0fd193004208a58ff6f353fde0012d35fdd72bc394') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"


## Dependencias de php

```
sudo apt-get install php-xml php-mbstring
```

## Actualizamos las dependencias

    php composer.phar update


## Referencia DI en PHP


Acá esta la documentación sobre DI
https://php-di.org/doc/getting-started.html

Y acá esta la implementación para ser usada junto a Slim
https://php-di.org/doc/frameworks/slim.html

## Referencia de Twig

https://twig.symfony.com/doc/3.x/api.html


## Referencia de mink dentro de behat

http://mink.behat.org/en/latest/


## Referencia de MinkExtension

MinkExtension es la librería que se encarga de unir Behat y Mink.

https://github.com/Behat/MinkExtension


## Mink Steps ya definidos


```
/^estoy en la página de inicio/
/^(?:|I )am on (?:|the )homepage$/
```

```
/^voy a la página de inicio/
/^(?:|I )go to (?:|the )homepage$/
```

```
/^estoy en "(?P<page>[^"]+)"$/
/^(?:|I )am on "(?P<page>[^"]+)"$/
```

```
/^voy a "(?P<page>[^"]+)"$/
/^(?:|I )go to "(?P<page>[^"]+)"$/
```

```
/^recargo la página$/
/^(?:|I )reload the page$/
```

```
/^voy hacia atrás una página$/
/^(?:|I )move backward one page$/
```

```
/^voy hacia adelante una página$/
/^(?:|I )move forward one page$/
```

```
/^presiono "(?P<button>(?:[^"]|\\")*)"$/
/^(?:|I )press "(?P<button>(?:[^"]|\\")*)"$/
```

```
/^sigo "(?P<link>(?:[^"]|\\")*)"$/
/^(?:|I )follow "(?P<link>(?:[^"]|\\")*)"$/
```

```
/^relleno "(?P<field>(?:[^"]|\\")*)" con "(?P<value>(?:[^"]|\\")*)"$/
/^(?:|I )fill in "(?P<field>(?:[^"]|\\")*)" with "(?P<value>(?:[^"]|\\")*)"$/
```

```
/^relleno con "(?P<value>(?:[^"]|\\")*)" a "(?P<field>(?:[^"]|\\")*)"$/
/^(?:|I )fill in "(?P<value>(?:[^"]|\\")*)" for "(?P<field>(?:[^"]|\\")*)"$/
```

```
/^relleno lo siguiente:$/
/^(?:|I )fill in the following:$/
```

```
/^selecciono "(?P<option>(?:[^"]|\\")*)" de "(?P<select>(?:[^"]|\\")*)"$/
/^(?:|I )select "(?P<option>(?:[^"]|\\")*)" from "(?P<select>(?:[^"]|\\")*)"$/
```

```
/^adicionalmente selecciono "(?P<option>(?:[^"]|\\")*)" de "(?P<select>(?:[^"]|\\")*)"$/
/^(?:|I )additionally select "(?P<option>(?:[^"]|\\")*)" from "(?P<select>(?:[^"]|\\")*)"$/
```

```
/^marco "(?P<option>(?:[^"]|\\")*)"$/
/^(?:|I )check "(?P<option>(?:[^"]|\\")*)"$/
```

```
/^desmarco "(?P<option>(?:[^"]|\\")*)"$/
/^(?:|I )uncheck "(?P<option>(?:[^"]|\\")*)"$/
```

```
/^adjunto el archivo "(?P<path>[^"]*)" a "(?P<field>(?:[^"]|\\")*)"$/
/^(?:|I )attach the file "(?P<path>[^"]*)" to "(?P<field>(?:[^"]|\\")*)"$/
```

```
/^debo ver "(?P<text>(?:[^"]|\\")*)"$/
/^(?:|I )should see "(?P<text>(?:[^"]|\\")*)"$/
```

```
/^no debo ver "(?P<text>(?:[^"]|\\")*)"$/
/^(?:|I )should not see "(?P<text>(?:[^"]|\\")*)"$/
```

```
/^debo ver texto que siga el patrón (?P<pattern>"(?:[^"]|\\")*")$/
/^(?:|I )should see text matching (?P<pattern>"(?:[^"]|\\")*")$/
```

```
/^no debo ver texto que siga el patrón (?P<pattern>"(?:[^"]|\\")*")$/
/^(?:|I )should not see text matching (?P<pattern>"(?:[^"]|\\")*")$/
```

```
/^la respuesta debe contener "(?P<text>(?:[^"]|\\")*)"$/
/^the response should contain "(?P<text>(?:[^"]|\\")*)"$/
```

```
/^la respuesta no debe contener "(?P<text>(?:[^"]|\\")*)"$/
/^the response should not contain "(?P<text>(?:[^"]|\\")*)"$/
```

```
/^el campo "(?P<field>(?:[^"]|\\")*)" debe contener "(?P<value>(?:[^"]|\\")*)"$/
/^the "(?P<field>(?:[^"]|\\")*)" field should contain "(?P<value>(?:[^"]|\\")*)"$/
```

```
/^el campo "(?P<field>(?:[^"]|\\")*)" no debe contener "(?P<value>(?:[^"]|\\")*)"$/
/^the "(?P<field>(?:[^"]|\\")*)" field should not contain "(?P<value>(?:[^"]|\\")*)"$/
```

```
/^la casilla de selección "(?P<checkbox>[^"]*)" debe estar marcada$/
/^the "(?P<checkbox>(?:[^"]|\\")*)" checkbox should be checked$/
```

```
/^la casilla de selección "(?P<checkbox>(?:[^"]|\\")*)" no debe estar marcada$/
/^the "(?P<checkbox>(?:[^"]|\\")*)" checkbox should not be checked$/
```

```
/^debo estar en "(?P<page>[^"]+)"$/
/^(?:|I )should be on "(?P<page>[^"]+)"$/
```

```
/^la URL debe seguir el patrón (?P<pattern>"(?:[^"]|\\")*")$/
/^the (?i)url(?-i) should match (?P<pattern>"(?:[^"]|\\")*")$/
```

```
/^el elemento "(?P<element>[^"]*)" debe contener "(?P<value>(?:[^"]|\\")*)"$/
/^the "(?P<element>[^"]*)" element should contain "(?P<value>(?:[^"]|\\")*)"$/
```

```
/^debo ver "(?P<text>(?:[^"]|\\")*)" en el elemento "(?P<element>[^"]*)"$/
/^(?:|I )should see "(?P<text>(?:[^"]|\\")*)" in the "(?P<element>[^"]*)" element$/
```

```
/^no debo ver "(?P<text>(?:[^"]|\\")*)" en el elemento "(?P<element>[^"]*)"$/
/^(?:|I )should not see "(?P<text>(?:[^"]|\\")*)" in the "(?P<element>[^"]*)" element$/
```

```
/^debo ver un elemento "(?P<element>[^"]*)"$/
/^(?:|I )should see an? "(?P<element>[^"]*)" element$/
```

```
/^no debo ver un elemento "(?P<element>[^"]*)"$/
/^(?:|I )should not see an? "(?P<element>[^"]*)" element$/
```

```
/^debo ver (?P<num>\d+) "(?P<element>[^"]*)" elementos$/
/^(?:|I )should see (?P<num>\d+) "(?P<element>[^"]*)" elements?$/
```

```
/^el código de estado de la respuesta debe ser (?P<code>\d+)$/
/^the response status code should be (?P<code>\d+)$/
```

```
/^el código de estado de la respuesta no debe ser (?P<code>\d+)$/
/^the response status code should not be (?P<code>\d+)$/
```

```
/^imprime la última respuesta$/
/^print last response$/
```

```
/^muestra la última respuesta$/
/^show last response$/
```
