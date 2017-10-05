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
use AppBundle\Constants\Constants;
use Symfony\Component\Validator\Constraints\Valid;

class CarpoolingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('slug')
            ->add('allerRetour', CheckboxType::class)
            ->add('nbPlacesRestantes', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('comment', TextareaType::class, array('required' => false))
			->add('trajet', TrajetType::class)
			->add('dateDepart', DateTimeType::class, Constants::$DATETIME_TYPE_CONF)
			->add('dateRetour', DateTimeType::class, Constants::$DATETIME_TYPE_CONF)
            ->add('acceptationAuto', CheckboxType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Carpooling::class
        ));
    }

    public function getName()
    {
        return 'appbundle_carpoolingtype';
    }
}
