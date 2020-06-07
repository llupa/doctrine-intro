Introduction to Doctrine
========================

### Prerequisites

PHP and Composer are ready to use on your local environment. For the purposes of this exercise PHP is installed locally 
and Composer is installed globally. Visit [PHP installation](https://www.php.net/manual/en/install.php) and 
[Composer installation](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) for more. 

#### Initial commit

For the initial we have only ran ove the commands to have a  Symfony skeleton application and declare our dependency of 
Doctrine. For this the purpose of this introduction we are using the [Doctrine ORM Pack](https://packagist.org/packages/symfony/orm-pack). 

```bash
# create project
composer create-project symfony/skeleton doctrine-intro

# add doctrine dependency
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
```

Additionally we are using the `maker-bundle` from Symfony in order to use Doctrine's helper commands to generate 
files/code. More on [Symfony packs](https://symfony.com/doc/current/setup.html#symfony-packs).
