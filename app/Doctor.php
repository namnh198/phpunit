<?php

namespace App;

class Doctor extends AbstractPerson
{
    protected function getTitle(): string
    {
        return 'Dr.';
    }
}
