<?php
namespace App\Model\Manager\Traits;

/**
 * Trait ManagerTrait
 * @package App\Model\Manager\Traits
 */
trait ManagerTrait {

    private static ?ManagerTrait $manager = null;

    /**
     * Return manager or new manager
     * @return self
     */
    public static function getManager(): self {
        if(is_null(self::$manager)) {
            self::$manager = new self();
        }
        return self::$manager;
    }
}