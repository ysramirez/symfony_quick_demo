<?php

namespace App\Form;

use App\Recursos\Cuestionario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CuestionarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oficina', ChoiceType::class, ['choices'  => [
                     'Gerencia' => 'gerencia',
                     'Administración' => 'administracion',
                     'Recursos Humanos' => 'recursos_humanos',
                ]
            ])
            ->add('pregunta', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cuestionario::class,
        ]);
    }
}
