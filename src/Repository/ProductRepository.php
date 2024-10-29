<?php
	
	namespace App\Repository;
	
	use App\Entity\Product;
	use App\Traits\HasCrudOperations;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Doctrine\Persistence\ManagerRegistry;
	
	class ProductRepository extends ServiceEntityRepository
	{
		use HasCrudOperations;
		
		public function __construct(ManagerRegistry $registry)
		{
			parent::__construct($registry, Product::class);
		}
		
		public function findFeatured(): array
		{
			return $this->createQueryBuilder('p')
			            ->where('p.featured = :featured')
			            ->andWhere('p.active = :active')
			            ->setParameter('featured', true)
			            ->setParameter('active', true)
			            ->getQuery()
			            ->getResult();
		}
		
		public function search(?string $search = null)
		{
			$qb = $this->createQueryBuilder('p');
			
			if ($search){
				$qb->orWhere('p.name LIKE :search')
					->orWhere('p.description LIKE :search')
					->setParameter('search', '%'.str_replace(' ', '%', $search).'%')
				;
			}
			return $qb
			            ->getQuery()
			            ->getResult();
		}
		
		public function totalStock()
		{
			return $this->createQueryBuilder('p')
			            ->select('SUM(p.stock)')
			            ->getQuery()
			            ->getSingleScalarResult();
		}
		
		public function countOfStock(int $level)
		{
			return $this->createQueryBuilder('p')
			            ->select('COUNT(p)')
			            ->where('p.stock <= :level')
			            ->setParameter('level', $level)
			            ->getQuery()
			            ->getSingleScalarResult();
		}
		
		public function countLowStock(int $level)
		{
			return $this->createQueryBuilder('p')
			            ->select('COUNT(p)')
			            ->where('p.stock < :level')
			            ->setParameter('level', $level)
			            ->getQuery()
			            ->getSingleScalarResult();
		}
	}
