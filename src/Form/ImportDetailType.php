<?php

namespace App\Form;

use App\Entity\ImportOrder;
use App\Entity\ImportOrderDetail;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImportDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('imorder',EntityType::class,['class'=>ImportOrder::class,'choice_label'=>'id','mapped'=>false])
            ->add('impro',EntityType::class,['class'=>Product::class,'choice_label'=>'name'])
            ->add('ImQuantity')
            ->add('save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ImportOrderDetail::class,
        ]);
    }
}
