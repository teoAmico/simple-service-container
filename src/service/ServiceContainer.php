<?php


namespace App\Service;

class ServiceContainer
{

    private $services = [];


    public function addService(string $name, \Closure $closure): void {
        if(!$this->hasService($name)){
            $this->services[$name] = $closure;
        }else{
            throw  new \Exception("Service name already exist!");
        }

    }

    public function getService(string $name){
        if(!$this->hasService($name)){
            return null;
        }
        if($this->services[$name] instanceof \Closure){
            $this->services[$name] = $this->services[$name]();
        }

        return $this->services[$name];

    }

    public function hasService(string $name): bool{
        return isset($this->services[$name]);
    }

    public function getServices(): array {
        return [
            'services' => array_keys($this->services)
        ];
    }

    public function remove(string $name) : void{
        if($this->hasService($name)){
            unset($this->services[$name]);
        }
    }

}