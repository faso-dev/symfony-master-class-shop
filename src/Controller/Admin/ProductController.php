<?php
	
	namespace App\Controller\Admin;
	
	use App\Entity\Product;
	use App\Form\ProductType;
	use App\Repository\ProductRepository;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;
	
	#[Route('/admin/products')]
	class ProductController extends AbstractController
	{
		public function __construct(
			private readonly ProductRepository $productRepository
		) {}
		
		#[Route('/', name: 'app_admin_product_list')]
		public function list(Request $request): Response
		{
			return $this->render('admin/product/list.html.twig', [
				'products' => $this->productRepository->search(
					$request->query->get('q')
				)
			]);
		}
		
		#[Route('/new', name: 'app_admin_product_create')]
		public function create(Request $request): Response
		{
			$product = new Product();
			$form = $this->createForm(ProductType::class, $product);
			
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$this->productRepository->save($product, true);
				
				return $this->redirectToRoute('app_admin_product_list');
			}
			
			return $this->render('admin/product/create.html.twig', [
				'form' => $form
			]);
		}
		
		#[Route('/{id}/edit', name: 'app_admin_product_edit')]
		public function edit(Request $request, Product $product): Response
		{
			$form = $this->createForm(ProductType::class, $product);
			
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$this->productRepository->save($product, true);
				
				return $this->redirectToRoute('app_admin_product_list');
			}
			
			return $this->render('admin/product/edit.html.twig', [
				'form' => $form,
				'product' => $product
			]);
		}
		
		#[Route('/{id}/delete', name: 'app_admin_product_delete', methods: ['POST'])]
		public function delete(Product $product): Response
		{
			$this->productRepository->remove($product, true);
			
			return $this->redirectToRoute('app_admin_product_list');
		}
	}
