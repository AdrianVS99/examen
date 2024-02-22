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

class VotosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $votos = $options['votos'];

        foreach ($votos as $voto) {
            $builder->add( $voto->getId(), IntegerType::class, [
                'label' => $voto->getSindicato()->getSindicato(), // Suponiendo que tienes un método getNombre() en tu entidad Sindicato
                'data' => $voto->getVotos(),
                'constraints' => [
                    new NotBlank(),
                    new Positive(),
                ], // Establecer el valor predeterminado del campo como el número de votos actual
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
