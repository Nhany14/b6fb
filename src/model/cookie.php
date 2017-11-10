<?php
require_once __DIR__ . '/../lib/utils.php';

class Cookie extends LazyLoadedDataContainer {
  protected function load(): array {
    self::extendExperity($__COOKIE);
    return $__COOKIE;
  }

  static public function validateParam($param): string {
    if (gettype($param) !== 'array') return '$param must be an array';

    $requiredkeys = ['expiry-extend'];
    foreach ($requiredkeys as $key) {
      if (!array_key_exists($key, $param)) return "\$param['$key'] doesn't exists";
    }

    return '';
  }

  public function update(): void {
    $data = $this->getData();

    $tobeset = array_diff_assoc($data, $__COOKIE);
    self::extendExperity($tobeset);

    $tobeunset = array_diff_key($__COOKIE, $data);
    self::unsetCookies(array_keys($tobeunset));
  }

  static private function extendExperity(array $data): void {
    $extend = $this->param['expiry-extend'];
    foreach ($data as $key => $value) {
      setcookie($key, $value, time() + $extend);
    }
  }

  static private function unsetCookies(array $fields): void {
    foreach ($fields as $key) {
      unset($__COOKIE[$key]);
      setcookie($key, '', time() - 0xFFFF);
    }
  }
}
?>
