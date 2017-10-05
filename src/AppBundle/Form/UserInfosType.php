<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Constants\Constants;
use AppBundle\Outils\FormOutils;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\UserInfos;

/**
 * User infos type
 * @author Messi
 *
 */
class UserInfosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
    		->add('username', 'text', array('label' => 'form.field.name', 'attr' => array('style' => 'width : 200px')))
    		->add('sexe', 'choice', array('choices'  => FormOutils::getSexesList(), 'label'  => ' ', 'multiple' => true, 'expanded' => true))
    	;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UserInfos::class
        ));
    }

    public function getName()
    {
        return 'appbundle_userinfostype';
    }
}
