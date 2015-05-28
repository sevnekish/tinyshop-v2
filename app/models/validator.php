<?php

use Symfony\Component\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Validation\DatabasePresenceVerifier as DatabasePresenceVerifier;


class Validator {

  /**
   * Validator factory instance.
   * 
   * @var \Illuminate\Validation\Factory
   */
  protected $factory;

  /**
   * Default messages for validation failures.
   * 
   * @var array
   */
  protected $messages = [
                         'required' => 'Your :attribute is required.',
                         'min'      => 'Your :attribute must be at least :min characters long.',
                         'max'      => 'Your :attribute must be a maximum of :max characters long.',
                         'between'  => 'Your :attribute must be between :min - :max characters long.',
                         'email'    => 'Your :attribute must be a valid email address',
                         'unique'   => 'Your :attribute must be a unique'
  ];

  /**
   * Create a new Validator factory instance.
   *
   * @param  \Illuminate\Database\Capsule\Manager $db
   * @return \Illuminate\Validation\Factory
   */
  public function __construct($db) {
    if ( !$this->factory)
    {
      /**
       * illuminate/translation (Translator) package need for correct work of Validator
       */
      $translator = new Translator('en');
      $this->factory = new Factory($translator);

      /**
       * To set database presence verifier we need database connection instance,
       * which is implements ConnectionResolverInterface. For this purpose 
       * Illuminate\Database\Capsule\Manager class, which we get from $db arg,
       * have getDatabaseManager() function.
       * With defined DatabasePresenceVerifier we can use rules such as: 
       *      unique:table,column,except,idColumn
       *      exists:table,column
       */
      $dbManager = $db->getDatabaseManager();
      $this->factory->setPresenceVerifier(new DatabasePresenceVerifier($dbManager));

    }
    return $this->factory;
  }

  public function __call($method, $args)
  {
    $factory = $this->factory;

    // looking for custom messages
    $args[2] = isset($args[2]) ? $args[2] : $this->messages;

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