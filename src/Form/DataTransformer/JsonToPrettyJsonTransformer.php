<?php
namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class JsonToPrettyJsonTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        if (is_array($value))
        {
            $v = (implode(',',$value));
            return $v;
        }
        return explode(',', $value);
    }

    public function reverseTransform($value)
    {
        return explode(',', $value);
    }
}