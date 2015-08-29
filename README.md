# Pimcore Bootstrap

Provides Bootstrap-specific areas for your themes.

## Installation

Using Composer:  

```
composer require pimcore-extensions/bootstrap
```

Pimcore will automatically copy the area files into your `website/var/areas` directory when you enable them in the admin.

Next, you'll have to make the views available. You can either copy the folders inside `views/scripts` into 
`website/views/scripts` or otherwise:

```php
<?php // website/lib/Website/Controller/Action.php

namespace Website\Controller;

use Pimcore\Controller\Action\Frontend;

class Action extends Frontend {
	
	public function init () {
		
        // ... other init code

        \Boostrap\Plugin::onFrontInit($this);
    }
}
```

## Release History

* 2015-08-29   0.2.0   Button area added. PHP 5.4 and pimcore 3.x compatibility.
* 2015-02-02   0.1.0   Force edit in view for bricks with edit.php.
* 2015-01-29   0.0.3   Grid area added.
* 2014-10-15   0.0.2   Plugin published to composer registry.
* 2015-10-15   0.0.1   Initial version of plugin.
