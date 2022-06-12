<?php

class Logger
{

    //-----------------------------------------------//
    // Private                                       //
    //-----------------------------------------------//

    private $mainPath;
    private $name;

    //-----------------------------------------------//
    // Public                                        //
    //-----------------------------------------------//

    public function __construct(string $mainPath = "Log", string $name = "log.txt") {
        try {
            if (!file_exists($mainPath)) {
                mkdir($mainPath, 0777, true);
                file_put_contents($mainPath.'/'.$name,"# ".$mainPath.'/'.$name);
            }
            $this->setMainPath($mainPath);
            $this->setName($name);
        } catch (\Exception $e) {
            Router::error("500");
            return false;
        } catch (\Error $e) {
            Router::error("500");
            return false;
        } catch (\Throwable $e) {
            Router::error("500");
            return false;
        }
        return true;
    }

    public function log(int $strong, string $title, string $message, int $code=0) {
        switch($strong) {
            case 0:
                $this->notif($title,$message);
                break;
            case 1:
                $this->warning($title,$message,$code);
                break;
            case 2:
                $this->error($title,$message,$code);
                break;
            case 3:
                $this->critical($title,$message,$code);
                break;
            default:
                break;
        }
        
    }
    public function critical(string $title, string $message, int $code=0, $callback = null) {
        file_put_contents($this->getMainPath().'/'.$this->getName(),"\n".($code!==0?"[ ".date("Y-m-d h:i:s")." ] CRITICAL [$code] : ":"[ ".date("Y-m-d h:i:s")." ] CRITICAL :")."$title \n $message",FILE_APPEND);
        if (is_callable($callback)) {
            $callback($code);
        }
    }
    public function error(string $title, string $message, int $code=0, $callback = null) {
        file_put_contents($this->getMainPath().'/'.$this->getName(),"\n".($code!==0?"[ ".date("Y-m-d h:i:s")." ] ERROR [$code] : ":"[ ".date("Y-m-d h:i:s")." ] ERROR :")."$title \n $message",FILE_APPEND);
        if (is_callable($callback)) {
            $callback($code);
        }
    }
    public function warning(string $title, string $message, int $code=0) {
        file_put_contents($this->getMainPath().'/'.$this->getName(),"\n".($code!==0?"[ ".date("Y-m-d h:i:s")." ] Warning [$code] : ":"[ ".date("Y-m-d h:i:s")." ] Warning :")."$title \n $message",FILE_APPEND);
    }
    public function notif(string $title, string $message) {
        file_put_contents($this->getMainPath().'/'.$this->getName(),"\n[ ".date("Y-m-d h:i:s")." ] ".$title." : ".$message,FILE_APPEND);
    }

    public function getMainPath() :string
    {
        return $this->mainPath;
    }

    public function setMainPath(string $mainPath) :string
    {
        return ( $this->mainPath = $mainPath );
    }

    public function getName() :string
    {
        return $this->name;
    }

    public function setName(string $name) :string
    {
        return ( $this->name = $name );
    }

}
