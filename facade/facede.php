<?php
    class DVDplayer{
        private static $instance;

        private function __construct()
        {

        }

        public static function getInstance(){
            if(!(self::$instance instanceof self)){
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function on(){
            echo '打开DVD'.PHP_EOL;
        }

        public function off(){
            echo '关闭DVD'.PHP_EOL;
        }

        public function play(){
            echo '播放DVD'.PHP_EOL;

        }

        public function pause(){
            echo '播放DVD'.PHP_EOL;

        }
    }

    class Popcorn{
        private static $instance;

        private function __construct()
        {
        }

        public function getInstance(){
            if(!(self::$instance instanceof self)){
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function on(){
            echo '打开爆米花机'.PHP_EOL;
        }

        public function off(){
            echo '关闭爆米花机'.PHP_EOL;
        }

        public function pop(){
            echo '制作爆米花'.PHP_EOL;
        }
    }

    class Projector{
        private static $instance;
        private function __construct()
        {
        }
        public function getInstance(){
            if(!(self::$instance instanceof self)){
                self::$instance = new self;
            }
            return self::$instance;
        }
        public function on(){
            echo '打开投影仪'.PHP_EOL;
        }

        public function off(){
            echo '关闭投影仪'.PHP_EOL;
        }

        public function focus(){
            echo '聚焦投影仪'.PHP_EOL;
        }
    }

    class scree{
        private static $instance;
        private function __construct()
        {
        }
        public static function getInstance(){
            if(!(self::$instance instanceof self)){
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function on(){
            echo '打开屏幕'.PHP_EOL;
        }

        public function off(){
            echo '关闭屏幕'.PHP_EOL;
        }

        public function up(){
            echo '屏幕上升'.PHP_EOL;
        }

        public function down(){
            echo '屏幕下降'.PHP_EOL;
        }

    }

    class Stereo{
        private static $instance;
        private function __construct(){

        }
        public function getInstance(){
            if(!(self::$instance instanceof self)){
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function on(){
            echo '打开音响'.PHP_EOL;
        }

        public function off(){
            echo '关闭音响'.PHP_EOL;
        }

        public function up(){
            echo '加大声音'.PHP_EOL;
        }
    }

    class TheaterLight{
        private static $instance;
        private function __construct()
        {
        }
        public function getInstance(){
            if(!(self::$instance instanceof self)){
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function on(){
            echo '打开剧场灯光'.PHP_EOL;
        }

    }