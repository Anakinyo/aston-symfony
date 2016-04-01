<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Aston\BackBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of PostType
 *
 * @author dev
 */
class PostType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('title', null, ['label' => 'Titre'])
            ->add('category', null, ['label' => 'Catégorie'])
            ->add('teaser', null, ['label' => 'teaser'])
            ->add('content', null, ['label' => 'contenu'])
            ->add('published', null, ['required' => false])
            ->add('createdAt', DateType::class)
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
    ]);
  }

}
