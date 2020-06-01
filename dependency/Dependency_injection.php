<?php

/**
 * Class AbstractConfig
 */
abstract class AbstractConfig{
    protected $storage;

    /**
     * AbstractConfig constructor.
     * @param $storage of data
     */
    public function __construct(string $storage)
    {
        $this->storage = $storage;
    }
}


interface Parameters{
    public function set($key,$value);
    public function get($key,$default);
}

class ArrayConfig extends AbstractConfig implements Parameters{
    public function get($key,$default){
        if(isset($this->storage[$key])){
            return $this->storage[$key];
        }
        return $default;
    }

    public function set($key,$value){
        $this->storage[$key] = $value;
    }

}

class Connection{
    protected $configuration;

    protected $host;

    public function __construct(Parameters $config)
    {
        $this->configuration = $config;
    }

    public function connect(){
        $host = $this->configuration->get('host');

        $this->host = $host;
    }

    public function getHost(){
        return $this->host;
    }
}

$connection = new Connection($this->config);
$connection->connect();