<?php
class JSONWriter extends Writer
{
  
    public function __construct(Formater $formater)
  {
    parent::__construct($formater);
  }
  
  public function write ($text)
  {
    header('Content-Type: application/json');
    return $this->formater->format($text));
  }
}