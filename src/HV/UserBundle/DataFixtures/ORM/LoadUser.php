<?php

namespace HV\UserBundle\DateFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use HV\UserBundle\Entity\User;

class LoadUser implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $listNames=array('Alexandre');
    foreach($listNames as $name)
    {
      $user=new User;
      $user->setUsername($name);
      $user->setPassword($name);
      $user->setSalt('');
      $user->setRoles(array('ROLE_AUTEUR'));
      $manager->persist($user);
    }
    $manager->flush();
  }
}
