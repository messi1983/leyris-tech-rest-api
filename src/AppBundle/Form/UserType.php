<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Constants\Constants;
use AppBundle\Outils\FormOutils;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * User type
 * @author Messi
 *
 */
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
    		->add('firstname', TextType::class)
    		->add('lastname', TextType::class)
    		->add('email', TextType::class)
//     		->add('sexe', 'choice', array('choices'  => FormOutils::getSexesList(), 'label'  => ' ', 'multiple' => true, 'expanded' => true))
    	;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class
        ));
    }
    
    public function getName()
    {
        return 'appbundle_usertype';
    }
}
