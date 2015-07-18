Yii2 Migration Utility
===================

This is a simple utility that writes the create table statement for you.
The table(s) must already exist.

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
+ foreign key
+ ***does not*** add indexes

***Note:*** Foreign keys default to CASCADE / DELETE so you may need to manually change these.

***Note:*** ___$tableOptions___ is added so make sure you have a var set.

***Note:*** ___$dbType___ is used with the if/then statements.

```$dbType = Yii::$app->db->driverName;```

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist "c006/yii2-migration-utility" "dev-master"
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

Demo: [http://demo.c006.us](http://demo.c006.us)


Usage
-----


###http://___[Your_Domain]___</span>/utility/index###




Updates
--------

+ Table prefix added
+ Column defaultValue allows for array/expression
+ Enum options escaping and uppercase


Contributors
-----------

+ [Insolita](https://github.com/Insolita) 
+ [Deele](https://github.com/Deele)



Comments / Suggestions
--------------------

Please provide any helpful feedback or requests.

Thanks.














