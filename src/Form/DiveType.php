<?php

namespace App\Form;

use App\Entity\Dive;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('location')
            ->add('dive_site')
            ->add('max_depth')
            ->add('dive_time')
            ->add('stops')
            ->add('stops_time')
            ->add('pre_dive_interval')
            ->add('dive_type', ChoiceType::class, [
                'choices' => array_flip(Dive::DIVETYPE)
            ])
            ->add('comments')
            ->add('stop_depth')
            ->add('title')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dive::class,
            'translation_domain' => 'forms'
        ]);
    }
}
