<?php
	
	namespace App\Controller\Shop;
	
	use App\Repository\ProductRepository;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;
	
	class ShopController extends AbstractController
	{
		public function __construct(
			private readonly ProductRepository $productRepository
		) {}
		
		#[Route('/', name: 'app_shop_index')]
		public function index(): Response
		{
			return $this->render('shop/index.html.twig', [
				'featured_products' => $this->productRepository->findFeatured()
			]);
		}
	}
