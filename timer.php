<?php
/**
 * Created by PhpStorm.
 * User: Milan
 * Date: 20.04.2017
 * Time: 10:42
 */
class Timer {
    private $start     = 0;
    private $stop      = 0;
    private $elapsed   = 0;

    /** Constructor *
     * @param bool $start
     */
    public function __construct( $start = true )
    {
        if ( $start )
            $this->start();
    }

    public function start()
    {
        $this->start = $this->_gettime();
    }

    protected function stop()
    {
        $this->stop    = $this->_gettime();
        $this->elapsed = $this->_compute();
    }

    protected function elapsed()
    {
        if ( !$this->elapsed )
            $this->stop();

        return $this->elapsed;
    }

    public function reset() {
        $this->start   = 0;
        $this->stop    = 0;
        $this->elapsed = 0;
    }

    private function _gettime() {
        $mtime = microtime();
        $mtime = explode( " ", $mtime );
        return $mtime[1] + $mtime[0];
    }

    private function _compute() {
        return $this->stop - $this->start;
    }
}
