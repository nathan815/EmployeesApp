<?php

namespace App\Utils;

class FlashMessage {

    public static function send($text, $type) {
        $_SESSION['flash_message']['text'] = $text;
        $_SESSION['flash_message']['type'] = $type;
    }

    public static function exists() {
        return isset($_SESSION['flash_message']);
    }

    public static function get() {
        $flash = isset($_SESSION['flash_message']) ? $_SESSION['flash_message'] : false;
        self::remove();
        return $flash;
    }

    public static function remove() {
        unset($_SESSION['flash_message']);
    }

    public static function getType() {
        return self::exists() ? self::get()['type'] : null;
    }

    public static function getText() {
        return self::exists() ? self::get()['text'] : null;
    }

}