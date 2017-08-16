<?php

namespace Home\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Home\PageBundle\Entity\Box;

class BoxType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('height')
            ->add('width')
            ->add('lenght');
    }

    /**
     * @param OptionsResolver $resolver
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        // don't map entities to forms - see

        $resolver->setDefaults(array(
            'data_class' => 'Home\PageBundle\Entity\Box'
            // You could also use 'Box::class' - notice that use Home\PageBundle\Entity\Box; on line 8
            //'data_class' => Box::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'home_pagebundle_box';
    }


}
