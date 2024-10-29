<?php
	
	namespace App\Command;
	
	use App\Entity\User;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Component\Console\Attribute\AsCommand;
	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Output\OutputInterface;
	use Symfony\Component\Console\Style\SymfonyStyle;
	use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
	
	#[AsCommand(
		name: 'app:create-admin',
		description: 'Creates a new admin user',
	)]
	class CreateAdminCommand extends Command
	{
		public function __construct(
			private readonly EntityManagerInterface $entityManager,
			private readonly UserPasswordHasherInterface $passwordHasher
		) {
			parent::__construct();
		}
		
		protected function execute(InputInterface $input, OutputInterface $output): int
		{
			$io = new SymfonyStyle($input, $output);
			
			$email = $io->ask('Email', 'admin@example.com');
			$firstName = $io->ask('Prénom', 'Admin');
			$lastName = $io->ask('Nom', 'User');
			$password = $io->askHidden('Mot de passe (caché)');
			
			$user = new User();
			$user->setEmail($email)
			     ->setFirstName($firstName)
			     ->setLastName($lastName)
			     ->setRoles(['ROLE_ADMIN'])
			     ->setPassword(
				     $this->passwordHasher->hashPassword($user, $password)
			     );
			
			$this->entityManager->persist($user);
			$this->entityManager->flush();
			
			$io->success('Admin user created successfully!');
			
			return Command::SUCCESS;
		}
	}
