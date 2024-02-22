<?php

namespace App\Form;

use App\Entity\Mesa;
use App\Entity\Sindicato;
use App\Entity\Voto;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;


class VotosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $votos = $options['votos'];

        foreach ($votos as $voto) {
            $builder->add($voto->getId(), TextType::class, [
                'label' => $voto->getSindicato()->getSindicato(),
                'data' => $voto->getVotos(),
                'constraints' => [
                    new Assert\NotBlank(),

                    new Assert\Regex(['pattern' => '/^\d+$/', 'message' => 'El número de votos debe ser un número entero.']),
                ],
            
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
            'votos' => [],
        ]);
    }
}
