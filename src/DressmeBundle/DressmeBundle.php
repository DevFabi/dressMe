<?php

namespace DressmeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DressmeBundle extends Bundle
{
	    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
