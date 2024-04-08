<?php

namespace App\Form\DataTransform;

use App\Form;
use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Citta;
use Symfony\Component\Form\Exception\TransformationFailedException;


class CittaToStringTransformer implements DataTransformerInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function transform($citta)
    {
        if (null === $citta) {
            return '';
        }

        return $citta->getNomeCitta();
    }

    public function reverseTransform($nomeCitta)
    {
        // Qui devi implementare la logica per ottenere l'entità Citta basata sul nome della città
        // Assumo che $repository sia un oggetto del tuo repository di entità Citta
        $citta = $this->em->getRepository(Citta::class)->findOneBy(['nome_citta' => $nomeCitta]);

        if (null === $citta) {
            throw new TransformationFailedException(sprintf('La città "%s" non esiste!', $nomeCitta));
        }

        return $citta;
    }
}
