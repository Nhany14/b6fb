<?php
require_once __DIR__ . '/base.php';
require_once __DIR__ . '/../../lib/utils.php';

class GameItem extends RawDataContainer implements Component {
  static protected function requiredFieldSchema(): array {
    return array_merge(parent::requiredFieldSchema(), [
      'game-name' => 'string',
    ]);
  }

  public function render(): Component {
    $urlQuery = $this->get('url-query');
    $id = $this->get('game-id');
    $description = $this->getDefault('description', '');

    return HtmlElement::create('a', [
      'href' => $urlQuery->assign([
        'type' => 'html',
        'page' => 'play',
        'game-id' => $id,
      ])->getUrlQuery(),
      HtmlElement::emmetBottom('article>figure', [
        HtmlElement::create('img', [
          'src' => $urlQuery->assign([
            'type' => 'file',
            'mime' => 'image/jpeg',
            'name' => $this->get('game-id'),
            'purpose' => 'game-img',
          ])->getUrlQuery(),
        ]),
        HtmlElement::create('figcaption', [
          $this->get('game-name'),
        ]),
        $description
          ? HtmlElement::emmetTop('.description', $description)
          : ''
      ]),
    ]);
  }
}
?>
