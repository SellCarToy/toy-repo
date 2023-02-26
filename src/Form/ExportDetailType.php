<?php

namespace App\Form;

use App\Entity\ExportOrder;
use App\Entity\ExportOrderDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExportDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('exorder',EntityType::class,['class'=>ExportOrder::class,'choice_label'=>'id','mapped'=>false])
            ->add('expro',EntityType::class,['class'=>ExportOrder::class,'choice_label'=>'name','mapped'=>false])
            ->add('ExQuantity')
            ->add('save',SubmitType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExportOrderDetail::class,
        ]);
    }
}
