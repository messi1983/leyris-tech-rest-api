<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Carpooling;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\ReservationCp;
use AppBundle\Constants\Constants;

class ReservationCpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('slug')
            ->add('nbPlaces', IntegerType::class)
			->add('multiGroupe', TextType::class, array('required' => false))
            ->add('etat', TextType::class)
            ->add('date', DateTimeType::class, Constants::$DATETIME_TYPE_CONF)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ReservationCp::class
        ));
    }

    public function getName()
    {
        return 'appbundle_reservationcptype';
    }
}
