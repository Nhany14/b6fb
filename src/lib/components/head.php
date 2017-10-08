<?php
require_once __DIR__ . '/base.php';

class Head implements Component {
  public function render(): Component {
    return HTMLElement::create('head', array(
      HTMLElement::create('meta', array('charset' => 'utf-8')),
      HTMLElement::create('title', array(
        new TextNode('Hello, World!!')
      ))
    ));
  }
}
?>
