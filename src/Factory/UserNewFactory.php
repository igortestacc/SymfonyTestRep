<?php

namespace App\Factory;

use App\Entity\UserNew;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<UserNew>
 */
final class UserNewFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return UserNew::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'age' => self::faker()->numberBetween(1, 100),
            'createdAt' => self::faker()->dateTime(),
            'dateBirth' => self::faker()->dateTime(),
            'updatedAt' => self::faker()->dateTime(),
            'username' => self::faker()->words(5, true),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(UserNew $userNew): void {})
        ;
    }
}
