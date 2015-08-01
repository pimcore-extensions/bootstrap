Pimcore Bootstrap
=================

Provides Bootstrap-specific areas for your themes.

Installation
------------

Using Composer:  

```
composer require pimcore-extensions/bootstrap
```

Composer will automatically copy the area files into your `website/var/areas` directory.

Next, you'll have to make the views available. You can either copy the folders inside `views/scripts` into 
`website/views/scripts` or otherwise:

```php
<?php // website/lib/Website/Controller/Action.php

namespace Website\Controller;

use Pimcore\Controller\Action\Frontend;

class Action extends Frontend {
	
	public function init () {
		
        // ... other init code

        $this->view->addScriptPath(PIMCORE_PLUGINS_PATH . '/Bootstrap/views/scripts');
    }
}
```
