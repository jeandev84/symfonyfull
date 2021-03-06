<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class VideoFormType
 * @package App\Form
 */
class VideoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created_at', DateType::class, [
                'label' => 'Set Date',
                'widget' => 'single_text' // single_text permet d'ajuster le libelle et l'input
            ])
            ->add('title', TextType::class, [
                'label' => 'Set video title',
                'data'  => 'Example title',
                'required' => false
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Add a video'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
