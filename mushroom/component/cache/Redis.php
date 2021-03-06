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

class Redis extends Core implements IFCache {

    var $redis;

    public function __construct($config) {
        $this->redis = Component::register('Redis', $config);
    }

    public function get($key) {
        return $this->redis->get($key);
    }

    public function set($key, $value, $expire = 3600) {
        return $this->redis->set($key, $value, $expire);
    
    }

    public function delete($key) {
        return $this->redis->delete($key);
    }
}
