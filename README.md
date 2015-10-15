# Pimcore Bootstrap

Provides Bootstrap-specific areas for your themes.

## What's inside
* [Accordion](http://getbootstrap.com/javascript/#collapse-example-accordion)
* [Alert](http://getbootstrap.com/javascript/#alerts)
* [Button](http://getbootstrap.com/css/#buttons)
* [Carousel](http://getbootstrap.com/javascript/#carousel)
* [Columns (grid)](http://getbootstrap.com/css/#grid)
* [Gallery](http://getbootstrap.com/components/#thumbnails)
* [Image](http://getbootstrap.com/css/#images-responsive)
* [Image with caption](http://getbootstrap.com/components/#thumbnails-custom-content)
* [Panel](http://getbootstrap.com/components/#panels)
* [Snippet](https://www.pimcore.org/wiki/pages/viewpage.action?pageId=14551599)
* [WYSIWYG Editor (with bootstrap styles configuration)](https://www.pimcore.org/wiki/display/PIMCORE3/WYSIWYG)

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

* 2015-10-15   0.3.0   Installation/setup simplified.
* 2015-08-29   0.2.0   Button area added. PHP 5.4 and pimcore 3.x compatibility.
* 2015-02-02   0.1.0   Force edit in view for bricks with edit.php.
* 2015-01-29   0.0.3   Grid area added.
* 2014-10-15   0.0.2   Plugin published to composer registry.
* 2015-10-15   0.0.1   Initial version of plugin.
