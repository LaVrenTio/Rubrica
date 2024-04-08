<?php

namespace App\Form;

use App\Controller;
use App\Entity\Contatti;
use App\Entity\Citta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\DataTransformerInterface;
use App\DataTransform\Form\CittaToStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;

class ContattiFormType extends AbstractType
{
    private $entityManager;
    private $cittatostringtrasform;

    public function __construct(EntityManagerInterface $em )
    {
        $this->entityManager = $em;
      
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('cognome')
            ->add('email', null, [
                'constraints' => [
                    new Assert\NotBlank(), // L'email non può essere vuota
                    new Assert\Email(),    // L'email deve essere un indirizzo email valido
                ],
            ])
            ->add('telefono', null, [
                'constraints' => [
                    new Assert\NotBlank(),        // Il campo telefono non può essere vuoto
                    new Assert\Type('numeric'),  // Il telefono deve essere un numero
                    new Assert\Length(['min' => 10, 'max' => 12]), // Il telefono deve essere lungo da 10 a 12 caratteri
                ],
            ])
            ->add('sesso', ChoiceType::class, [
                'choices' => [
                    'gender'=> '',
                    'Maschio' => 'm',
                    'Femmina' => 'f',
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('mycitta', EntityType::class, [
                'class' => Citta::class,
                'choice_label' => 'nome_citta', // il nome del campo da utilizzare come etichetta delle opzioni
                'attr' => ['class' => 'form-control'],// Applica il trasformatore
                'mapped'=>true
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contatti::class,
        ]);
    }
}
