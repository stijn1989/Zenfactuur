<?php
namespace Diagro\Zenfactuur\Entity;


interface ClientType
{
    const PARTICULIER_UIT_EU = 0;
    const BELGISCH_BEDRIJF = 1;
    const BEDRIJF_UIT_EU = 2;
    const KLANT_BUITEN_EU = 3;
}