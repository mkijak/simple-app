<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repository;

use App\Domain\User;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class Users extends DocumentRepository implements \App\Domain\Users
{
    public function add(User $user): void
    {
        $this->getDocumentManager()->persist($user);
        $this->getDocumentManager()->flush();
    }

    public function remove(User $user): void
    {
        $this->getDocumentManager()->remove($user);
        $this->getDocumentManager()->flush();
    }

    public function findByEmail(string $email): ?User
    {
        return $this->findOneBy(['email.email' => $email]);
    }
}
