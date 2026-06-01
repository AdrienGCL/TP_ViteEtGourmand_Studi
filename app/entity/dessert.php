<?php

namespace app\entity;

class Dessert extends Plat
{
    // Remplissage des propriétés d'après un array
    public function fromArray(array $data): self
    {

        $this->setId((int)$data['dessert_id']);
        $this->setLibelle((string)$data['libelle']);

        return $this;
    }
}