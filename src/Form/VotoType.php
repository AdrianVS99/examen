<?php

namespace App\Form;

use App\Entity\Mesa;
use App\Entity\Sindicato;
use App\Entity\Voto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('votos')
            ->add('sindicato', EntityType::class, [
                'class' => Sindicato::class,
'choice_label' => 'id',
            ])
            ->add('mesa', EntityType::class, [
                'class' => Mesa::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voto::class,
        ]);
    }
}
