<?php

  namespace Eskirex;

  class Cache
  {

    var $path      = 'cache';
    var $extension = '.cache';

    public function __construct ($settings = false)
    {
      $this->path      = $settings['path'] ?? $this->path;
      $this->extension = $settings['extension'] ?? $this->extension;
    }

    public function set ($name, $value)
    {
      if (!file_exists($this->path . $name . $this->extension))
      {
        $this->create($name);
      }
      $value = serialize($value);
      file_put_contents($this->path . $name . $this->extension, $value);
    }

    public function get ($name)
    {
      if (file_exists($this->path . $name . $this->extension))
      {
        return unserialize(file_get_contents($this->path . $name . $this->extension));
      }
      else
      {
        return false;
      }
    }

    public function has($name){
      if (file_exists($this->path . $name . $this->extension))
      {
        return true;
      }
      else
      {
        return false;
      }
    }

    public function create ($name)
    {
      $file = fopen($this->path . $name . $this->extension, 'a+');
      fclose($file);
    }
  }