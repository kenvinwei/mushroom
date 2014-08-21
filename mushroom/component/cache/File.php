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
    \mushroom\library\File as MrFile;

class File extends Core implements IFCache {

    var $path;

    public function __construct($config) {
        $this->path = isset($config['path']) && !empty($config['path']) ? $config['path'] : MR_RUNTIME_PATH . '/cache';
    }

    public function get($key) {
        $file = $this->makeFile($key);
        if (false !== ($data = MrFile::read($file))) {
            $data = str_replace("<?exit('Denied!')?>",'', $data);
            preg_match('/^(\d+)mushroom\/\/\-\-\>/is', $data, $match);
            $life = isset($match[1]) ? $match[1] : 0 ;
            if($life < MR_RT_TIMESTAMP && $life > 0) {
                MrFile::delete($file);
                return false;
            }
            $replace = isset($match[0]) ? $match[0] : '' ;
            $data = str_replace($replace, '', $data);
            return $data;
        }
        return false;
    }

    public function set($key, $value, $expire = 3600) {
        $file = $this->makeFile($key);
        $life = $expire == 0 ? 0 : $expire + MR_RT_TIMESTAMP;
        $data = "<?exit('Denied!')?>" . $life . 'mushroom//-->' . $value;
        return MrFile::write($file, $data);
    }

    public function delete($key) {
        $file = $this->makeFile($key);
        return MrFile::delete($file);
    }

    private function makeFile($key) {
        $hash = md5($key);
        return $this->path.'/'.substr($hash, 15, 2).'/'.$hash.'.php';
    }
}
