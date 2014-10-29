<?php
class Memcache_handle
{
    var $_memcache = null;   
    var $host = '127.0.0.1';
    var $port  = 11211;
    var $exprie = 1200;
    var $compression = false;
    
    function __construct()
    {	
        $option = Config::get(Null, 'memcache');		
        if($option)
        {			
            foreach($option as $key=>$val)
            {
                $this->$key = $val;
            }
        }
        $this->connect();
    }

    /**
     *    连接到缓存服务器
     *
     *    @author    RIRNY
     *    @param     array $options
     *    @return    bool
     */
    function connect()
    {
       
        if (!extension_loaded('memcache') && !extension_loaded('memcached')) {
            show_error('Memcache扩展不存在');
        }else if(extension_loaded('memcache')){
			 $this->_memcache = new Memcache;
		}else{
			 $this->_memcache = new Memcached;
		}        
        $this->_memcache->addServer($this->host, $this->port);		
        // $this->_memcache->connect($this->host, $this->port);       
    }

    /**
     *    写入缓存
     *
     *    @author    RIRNY
     *    @param    none
     *    @return    void
     */
    function set($key, $value, $expire = null)
    {        
        $expire = ($expire == null) ? $this->exprie : $expire;
        if(is_array($value))
        {	
            return $this->_memcache->set($key, $value, MEMCACHE_COMPRESSED, $expire);
        }else{
            return $this->_memcache->set($key, $value, false, $expire);
        }       
    }
    
    /**
     * (功能描述)
     *
     * @param    (类型)     (参数名)    (描述)
     */
    function add($key, $value, $expire = null)
    {
        $flag = $this->compression;
        $expire = ($expire == null) ? $this->exprie : $expire;       
        return $this->_memcache->add($key, $value, $flag, $expire);    
    }
    /**
     *    获取缓存
     *
     *    @author    RIRNY
     *    @param     string $key
     *    @return    mixed
     */
    function get($key)
    {
		if(!$key) Return false;
        return $this->_memcache->get($key);
    }

    /**
     *    清空缓存
     *
     *    @author    RIRNY
     *    @return    bool
     */
    function clear()
    {
        return $this->_memcache->flush();
    }

    function delete($key)
    {
        return $this->_memcache->delete($key);
    }

     public function increment($key, $val = 1)
    {
        return $this->_memcache->increment($key, (int)$val);
    }

    /**
     * 自减
     * @param string $key
     * @param int $val
     * @return int
     */
    public function decrement($key, $val = 1)
    {
        return $this->_memcache->decrement($key, $val);
    }


    /**
     * 是否已存在
     */
    public function isExists($key)
    {
        $res = $this->_memcache->get($key);
        return !empty($res);
    }

    function getStats()
    {
        Return $this->_memcache->getExtendedStats();   
    }
}