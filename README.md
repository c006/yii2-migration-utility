Yii2 Migration Utility
===================

**Current Version - v2.0.4**  `2020-06`

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
+ composite keys
+ foreign key
+ indexes
+ Table data


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-source "c006/yii2-migration-utility" ">=2.0.4"
```

or add

```
"c006/yii2-migration-utility": ">=2.0.4"
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


Screen Capture
-------

Image: [https://drive.google.com/file/d/18TwwvvN4r9u7zQ537i5LsP3XQe6aizMp/view?usp=sharing](https://drive.google.com/file/d/18TwwvvN4r9u7zQ537i5LsP3XQe6aizMp/view?usp=sharing)


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



Comments / Suggestions
--------------------

Please provide any helpful feedback or requests.

Thanks.














