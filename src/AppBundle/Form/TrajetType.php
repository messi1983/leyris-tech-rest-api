<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Constants\Constants;
use AppBundle\Entity\Trajet;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
    		->add('villeDepart', TextType::class)
    		->add('pointDepart', TextType::class)
    		->add('villeArrivee', TextType::class)
    		->add('pointArrivee', TextType::class)
    	;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Trajet::class
        ));
    }
    
    public function getName()
    {
        return 'appbundle_trajettype';
    }
}
