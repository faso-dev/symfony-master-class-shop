<?php
	
	namespace App\Controller\Admin;
	
	use App\Repository\ProductRepository;
	use Doctrine\Common\Collections\Criteria;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;
	
	#[Route('/admin')]
	class DashboardController extends AbstractController
	{
		public function __construct(
			private readonly ProductRepository $productRepository
		) {}
		
		#[Route('/', name: 'app_admin_dashboard')]
		public function index(): Response
		{
			$stats = [
				'total_products' => $this->productRepository->count([]),
				'active_products' => $this->productRepository->count(['active' => true]),
				'featured_products' => $this->productRepository->count(['featured' => true]),
				'out_of_stock' => $this->productRepository->countOfStock(level: 2),
				'low_stock' => $this->productRepository->countLowStock(level: 5),
				'total_stock' => $this->productRepository->totalStock(),
				'latest_products' => $this->productRepository->findBy(
					[],
					['id' => 'DESC'],
					5
				),
			];
			
			return $this->render('admin/dashboard.html.twig', [
				'stats' => $stats
			]);
		}
	}
