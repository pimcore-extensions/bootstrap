# Pimcore Bootstrap

Provides Bootstrap-specific areas for your themes.

## Installation

Using Composer:

```
composer require pimcore-extensions/bootstrap
```

Enable plugin in the admin.

Add areablock editable in your view script:
```
<?= $this->areablock('content') ?>
```

## Release History

* 2015-08-29   0.2.0   Button area added. PHP 5.4 and pimcore 3.x compatibility.
* 2015-02-02   0.1.0   Force edit in view for bricks with edit.php.
* 2015-01-29   0.0.3   Grid area added.
* 2014-10-15   0.0.2   Plugin published to composer registry.
* 2015-10-15   0.0.1   Initial version of plugin.
