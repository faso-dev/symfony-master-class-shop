<?php
	
	namespace App\Form;
	
	use App\Entity\Product;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
	use Symfony\Component\Form\Extension\Core\Type\MoneyType;
	use Symfony\Component\Form\Extension\Core\Type\NumberType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	class ProductType extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options): void
		{
			$builder
				->add('name', TextType::class, [
					'label' => 'Nom du produit',
					'attr' => ['placeholder' => 'Ex: Super Produit']
				])
				->add('price', MoneyType::class, [
					'label' => 'Prix',
					'currency' => 'EUR'
				])
				->add('description', TextareaType::class, [
					'label' => 'Description',
					'attr' => ['rows' => 5]
				])
				->add('image', TextType::class, [
					'label' => 'Chemin de l\'image',
					'attr' => ['placeholder' => '/images/products/mon-image.jpg']
				])
				->add('stock', NumberType::class, [
					'label' => 'Stock disponible'
				])
				->add('featured', CheckboxType::class, [
					'label' => 'Mettre en avant ?',
					'required' => false
				])
				->add('active', CheckboxType::class, [
					'label' => 'Produit actif ?',
					'required' => false
				])
			;
		}
		
		public function configureOptions(OptionsResolver $resolver): void
		{
			$resolver->setDefaults([
               'data_class' => Product::class,
           ]);
		}
	}
