<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Domain\HashedPassword;
use App\Domain\User;
use App\Domain\Users;
use Behat\Behat\Context\Context;
use Doctrine\ODM\MongoDB\DocumentManager;

class UserContext implements Context
{
    public function __construct(
        private Users $users,
        private DocumentManager $dm,
    ) {
    }

    /**
     * Creates User if necessary
     *
     * @Given User with email :email exists
     */
    public function userWithEmailExists($email)
    {
        if($this->users->findByEmail($email)) {
            return;
        }

        $this->users->add(User::create($email, 'zxzxzx'));
    }

    /**
     * Changes user password
     *
     * @Given user with email :email authorizes with password :password
     */
    public function userWithEmailAuthorizesWithPassword($email, $password)
    {
        if(!$user = $this->users->findByEmail($email)) {
            throw new \Exception(sprintf('User with email %s does not exist', $email));
        }

        $r = new \ReflectionClass($user);
        $p = $r->getProperty('password');
        $p->setAccessible(true);
        $p->setValue($user, new HashedPassword($password));

        $this->dm->flush();
    }

    /**
     * Creates User if necessary
     *
     * @Given User with email :email does not exist
     */
    public function userWithEmailDoesNotExist($email)
    {
        if($user = $this->users->findByEmail($email)) {
            $this->users->remove($user);
        }
    }
}
