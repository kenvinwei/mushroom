<?php

/**
 * Mushroom
 * 
 * An open source php application framework for PHP 5.3.0 or newer
 *
 * @author    mengfk <Mushroom Dev Team>
 * @copyright Copyright (C) 2014 http://mushroom.dreamans.com All rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0.txt
 * @link      http://mushroom.dreamans.com
 */

namespace mushroom\component\cache;

use \mushroom\core\Core as Core,
    \mushroom\core\Component as Component;

class Memcache extends Core implements IFCache {

    var $memcache;

    public function __construct($config) {
        $this->memcache = Component::register('Memcache', $config);
    }

    public function get($key) {
        return $this->memcache->get($key);
    }

    public function set($key, $value, $expire = 3600) {
        return $this->memcache->set($key, $value, $expire);
    
    }

    public function delete($key) {
        return $this->memcache->delete($key);
    }
}
