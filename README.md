P2Uuid v1.0.2
=============

A simple wrapper of [ramsey/uuid](https://github.com/ramsey/uuid) as helpers for Yii 2 Framework.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist p2made/yii2-uuid "*"
```

or add

```
"p2made/yii2-uuid": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by:


```php
	$uuid = \p2made\helpers\Uuid\UuidHelpers::uuid();
	$uuid = \p2made\helpers\Uuid\UuidHelpers::uuid($subDomain);
```



