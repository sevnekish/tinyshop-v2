<?php

use Symfony\Component\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Validation\DatabasePresenceVerifier as DatabasePresenceVerifier;


class Validator {


  protected $factory;

  public function __construct($db) {
    if ( ! $this->factory)
    {
      $translator = new Translator('en');
      $this->factory = new Factory($translator);

      $dbManager = $db->getDatabaseManager();

      $this->factory->setPresenceVerifier(new DatabasePresenceVerifier($dbManager));
    }
    return $this->factory;
  }

  public function __call($method, $args)
  {
    $factory = $this->factory;
    switch (count($args))
    {
    case 0:
      return $factory->$method();
    case 1:
      return $factory->$method($args[0]);
    case 2:
      return $factory->$method($args[0], $args[1]);
    case 3:
      return $factory->$method($args[0], $args[1], $args[2]);
    case 4:
      return $factory->$method($args[0], $args[1], $args[2], $args[3]);
    default:
      return call_user_func_array(array($factory, $method), $args);
    }
  }

}