<?php

namespace WSP\MemberBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use SP\MemberBundle\Form\Type\DeskPictureType;

class DeskType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('firstname','text', array('max_length' => 128, 'required' => true,))
            ->add('lastname','text', array('max_length' => 128, 'required' => true,))
            ->add('mailadress','email',array('max_length' => 128, 'required' => true,));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'SP\MemberBundle\Entity\Member',
        );
    }

    public function getName()
    {
        return 'Member';
    }
}
