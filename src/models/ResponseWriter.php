<?php
abstract class ResponseWriter
{
  // Attribut contenant l'instance du formateur que l'on veut utiliser.
  protected $formater;
}  
  abstract public function write($text);
  
  // Nous voulons une instance d'une classe implémentant Formater en paramètre.
  public function __construct(Formater $formater)
  {
    $this->formater = $formater;
  }