<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Authors;

class MoviesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du film'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false
            ])
            ->add('date', DateType::class, [
                'format' => 'ddMMMMyyy',
                'years' => range(1950, date('Y')),
                'label' => 'Date de production',
                'required' => false
            ])
            ->add('country', TextType::class, [
                'label' => 'Origine',
                'required' => false
            ])
            ->add('cover', TextType::class, [
                'label' => 'Jacket du film',
                'required' => false
            ])
            ->add('link', TextType::class, [
                'label' => 'Lien Allociné',
                'required' => false
            ])
            ->add('author', EntityType::class, [
                'label' => 'Réalisateur',
                'class' => Authors::class,
                'choice_label' => 'name',
                'required' => false
            ])
            ->add('save', SubmitType::class);
    }
}