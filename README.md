Yii2 Migration Utility
===================

**Current Version - v2.0.0**

+ Add JqueryAsset to DefaultController

This is a utility that writes the create table statement for migrations.
The table(s), indexes, foreign keys must already exist.

Foreign Key - uses link table and numbering, table / columns had potential to be too long

Supports

+ MySQL 
+ MsSQL
+ PgSQL
+ SQLite

It automatically writes out all:

+ tables
+ columns
+ column types
+ column defaults
+ primary keys
+ composite PKs
+ foreign key
+ indexes
+ Table data


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-source "c006/yii2-migration-utility" "dev-master"
```

or add

```
"c006/yii2-migration-utility": "dev-master"
```

to the require section of your `composer.json` file.


Required
--------

Update either ***config/web.php*** (basic) or ***config/main.php*** (advanced)

>
        'modules'    => [
            ...
            ...
            ...
            'utility' => [
                'class' => 'c006\utility\migration\Module',
            ],
        ],



The tables must already exist in website schema.


Demo
-------

Demo: [http://c006.us](http://c006.us)

Demo is currently down


Usage
-----


###http://___[Your_Domain]___</span>/utility###

or

###http://___[Your_Domain]___</span>/?r=/utility###




Updates
--------

+ Table options per database type
+ Table indexes
+ Table data


Contributors
-----------

+ [Insolita](https://github.com/Insolita) 
+ [Deele](https://github.com/Deele)
+ Sedov Sergey
+ fedemotta
+ derekisbusy
+ kvasyl



Comments / Suggestions
--------------------

Please provide any helpful feedback or requests.

Thanks.














