<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Cocur\Slugify\Slugify;


class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('slugfy', array($this, 'slugfy')),
        );
    }

    public function slugfy($value)
    {
       return (new Slugify())->slugify($value);
    }
}



?>

