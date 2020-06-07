Introduction to Doctrine
========================

### Prerequisites

PHP and Composer are ready to use on your local environment. For the purposes of this exercise PHP is installed locally 
and Composer is installed globally. Visit [PHP installation](https://www.php.net/manual/en/install.php) and 
[Composer installation](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) for more. 

#### Initial commit

For the initial commit we have only ran the commands to have a  Symfony skeleton application and declare our dependency of 
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

#### Add entities with primitive properties

In this commit we will first set up our Doctrine settings. For the purposes of this introduction we will use SQLite. All
we have to do is change the `DATABASE_URL` parameter in our `.env` to `sqlite:///%kernel.project_dir%/var/data.db`.

In order to test that you have a successful database connection run the following command: 

```bash
bin/console doctrine:database:create
```

If everything is successful you should read `Created database .../doctrine-intro/var/data.db for connection named default`.
Where `...` is your local directory location.

Now we can continue to create our entities. We will work with [Publisher](doc/make-publisher.md), [Book](doc/make-book.md), 
[Author](doc/make-author.md) and [Address](doc/make-address.md). All of them will first 
have primitive property values. To create them we run the following command for each entity.

```bash
bin/console make:entity
```

Last we run the following command to synchronise our physical database schema with our application's schema.

```bash
bin/console doctrine:schema:create
```

You should see a warning telling you that this operation should not be executed in a production environment and a success 
message stating `[OK] Database schema created successfully!`

Another way to keep your physical database schema with the application's schema is with another component from Doctrine
included in the ORM pack named Doctrine Migration(s). 

At this point, we have created our entities and their ORM mappings. Instead of using `doctrine:schema:create` we run: 

```
bin/console doctrine:migrations:diff
```

This command will add a MigrationVERSION class in the configured `dir_name` of our `doctrine_migrations.yaml` file. Since
this is the first time we are doing a diff against an empty schema, you will notice that Doctrine has added all table
creation queries. Go on and execute it: 

```
 bin/console doctrine:migrations:migrate
```

The end [result](doc/migration/first-diff.md) is the same as the first command shown above. This way offers more control and lets you have _surgical precision_
on your native SQL queries.
