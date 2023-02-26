<?php

namespace App\Form;

use App\Entity\ImportOrder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImportOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('id', EntityType::class, ['class'=>ImportOrder::class, 'choice_label'=>'ID', 'mapped'=>false])
            ->add('id')
            ->add('ImUser')
            ->add('time',DateType::class,['label'=>'CreatedDate'])
            ->add('save',SubmitType::class,['label'=>'Next'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ImportOrder::class,
        ]);
    }
}