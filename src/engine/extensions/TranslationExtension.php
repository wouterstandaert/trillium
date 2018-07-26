<?php

namespace App\Extensions;

use Twig_Extension;
use Twig_SimpleFunction;

class TranslationExtension extends Twig_Extension
{
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('translate', [$this, 'translate'])
        ];
    }


    public function translate($key)
    {
        // @todo: make this dynamic

        return $key;
    }
}