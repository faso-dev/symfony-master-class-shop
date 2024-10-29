<?php
	
	namespace App\Controller\Shop;
	
	use App\Repository\ProductRepository;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;
	
	#[Route('/products')]
	class ProductController extends AbstractController
	{
		public function __construct(
			private readonly ProductRepository $productRepository
		) {}
		
		#[Route('/', name: 'app_shop_product_list')]
		public function list(Request $request): Response
		{
			return $this->render('shop/product/list.html.twig', [
				'products' => $this->productRepository->search(
					$request->query->get('q')
				)
			]);
		}
		
		#[Route('/{id}', name: 'app_shop_product_show')]
		public function show(int $id): Response
		{
			$product = $this->productRepository->find($id);
			
			if (!$product || !$product->isActive()) {
				throw $this->createNotFoundException('Produit non trouvé');
			}
			
			return $this->render('shop/product/show.html.twig', [
				'product' => $product
			]);
		}
	}
