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

namespace mushroom\component;

use \mushroom\core\Core as Core,
    \mushroom\library\Redis as MrRedis;

class Redis extends MrRedis {

    public function __construct($config) {
        parent::__construct($config);
	}
}
