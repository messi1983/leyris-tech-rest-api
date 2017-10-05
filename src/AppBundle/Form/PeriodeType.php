<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Constants\Constants;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Periode;

class PeriodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
    		->add('dateDebut', 'date', array('label' => 'form.field.date.start', 'required' => false, 'widget' => 'single_text', 'format' => 'dd-MM-yyyy', 'attr' => array('class' => 'datepicker', 'style' => 'width : 100px')))
    		->add('dateFin', 'date', array('label' => 'form.field.date.end', 'required' => false, 'widget' => 'single_text', 'format' => 'dd-MM-yyyy', 'attr' => array('class' => 'datepicker', 'style' => 'width : 100px')))
    	;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Periode::class
        ));
    }

    public function getName()
    {
        return 'appbundle_periodetype';
    }
}
