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
            ->add('firstname')
            ->add('lastname')
            ->add('mailadress');
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
