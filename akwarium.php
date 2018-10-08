<?php
/**
 * Created by PhpStorm.
 * User: jarek
 * Date: 05.10.2018
 * Time: 17:29
 */
declare(strict_types=1);

/**
 * Interface Moveable
 */
interface Moveable
{
    /**
     *
     */
    public function move(): void;
}

/**
 * Interface Breathable
 */
interface Breathable
{
    /**
     *
     */
    public function breathe(): void;
}

/**
 * Interface IntentionallyMoveable
 */
interface IntentionallyMoveable
{
    /**
     *
     */
    public function move(): void;
}

/**
 * Interface UnIntentionallyMoveable
 */
interface UnIntentionallyMoveable
{
    /**
     *
     */
    public function move(): void;
}

/**
 * Class Animal
 */
abstract class Animal implements Breathable, Moveable, IntentionallyMoveable
{
}

/**
 * Class Fish
 */
abstract class Fish extends Animal
{
    /**
     * @var string
     */
    protected $name;

    /**
     * Fish constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     *
     */
    public function breathe(): void
    {
        // wszystkie podobnie
    }

    /**
     *
     */
    public function move(): void
    {
        // w jakis tam sposob
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}

/**
 * Class Halibut
 */
final class Halibut extends Fish
{

    /**
     *
     */
    public function move(): void
    {
        // Halibut rusza sie troche inaczej
    }

    /**
     *
     */
    public function breathe(): void
    {
        // a Halibut zupelnie inaczej
        // parent::breathe();
    }

}

/**
 * Class Dorsz
 */
final class Dorsz extends Fish
{


}

/**
 * Class Rekin
 */
final class Rekin extends Fish
{


}

/**
 * Class Plant
 */
abstract class Plant implements Breathable
{
    /**
     *
     */
    public function breathe(): void
    {
        //
    }
}

/**
 * Class Glony
 */
final class Glony extends Plant implements Moveable, UnIntentionallyMoveable
{
    /**
     *
     */
    public function move(): void
    {
        // mimowolnie
    }
}

/**
 * Class Java
 */
final class Java extends Plant
{
}

/**
 * Class Aquarium
 */
abstract class Aquarium
{
    /**
     * @var Water
     */
    protected $water;

    /**
     * @var int
     */
    protected $height;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $length;

    /**
     * @var string
     */
    protected $material;

    /**
     * @var array
     */
    protected $fishes = [];

    /**
     * @var array
     */
    protected $plants = [];

    /**
     * Aquarium constructor.
     * @param int $height
     * @param int $width
     * @param int $length
     * @param string $material
     */
    public function __construct(int $height, int $width, int $length, string $material)
    {
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
        $this->material = $material;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'Aquarium height: %d, widthL %d, length: %d, material: %s, capacity: %d',
            $this->height,
            $this->width,
            $this->length,
            $this->material,
            $this->getCapacity()
        );
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return ($this->height * $this->width * $this->length) / 1000;
    }

    /**
     * @return string
     */
    public function getMaterial(): string
    {
        return $this->material;
    }

    /**
     * @param int $litres
     * @throws Exception
     */
    public function pourWater(int $litres): void
    {
        if ($litres > $this->getCapacity()) {
            throw new \Exception(
                sprintf('Za dużo wody, akwarium ma pojemność %d litrów. ', $this->getCapacity())
            );
        }

        if ($litres == 0 || $litres < 20) {
            throw new  \Exception('Nie wlano wody lub jest jej za mało');
        }

        try {
            $this->water = new TapWater($litres);
        } catch (\Exception $ex) {
            // handle exception
        }

    }

    /**
     * @param Fish $fish
     */
    public function addFish(Fish $fish): void
    {
        array_push($this->fishes, $fish);
    }

    /**
     * @param Plant $plant
     */
    public function addPlant(Plant $plant): void
    {
        array_push($this->plants, $plant);
    }

    /**
     * @return array
     */
    public function getFishes(): array
    {
        return $this->fishes;
    }

    /**
     * @return array
     */
    public function getPlants(): array
    {
        return $this->plants;
    }
}

/**
 * Class Material
 */
final class Material
{
    /**
     * GLASS
     */
    const GLASS = 'GLASS';

    /**
     * WOOD
     */
    const WOOD = 'WOOD';
}

/**
 * Class GlassAquarium
 */
class GlassAquarium extends Aquarium
{
    /**
     * @var string
     */
    private $color;

    /**
     * GlassAquarium constructor.
     * @param int $height
     * @param int $width
     * @param int $length
     * @param string $color
     */
    public function __construct(int $height, int $width, int $length, string $color)
    {
        $this->color = $color;
        parent::__construct($height, $width, $length, Material::GLASS);
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

}

/**
 * Class Water
 */
abstract class Water
{

}

/**
 * Class TapWater
 */
final class TapWater extends Water
{
    /**
     * @var int
     */
    private $capacity;

    /**
     * TapWater constructor.
     * @param int $liters
     * @throws Exception
     */
    public function __construct(int $liters)
    {
        if (is_int($liters) && $liters > 0) {
            $this->capacity = $liters;
        }

        throw new \Exception('Water cannot be constructed. ');
    }
}

$aquarium = new GlassAquarium(40, 50, 20, 'red');
try {
    $aquarium->pourWater(40);
} catch (\Exception $e) {
    echo $e->getMessage();
}

$fish1 = new Halibut('Bolek');
$fish2 = new Rekin('Lolek');
$plant1 = new Glony;

$aquarium->addFish($fish1);
$aquarium->addFish($fish2);
$aquarium->addPlant($plant1);

echo PHP_EOL . PHP_EOL;
var_dump($aquarium->getPlants());
echo PHP_EOL;
var_dump($aquarium->getFishes());
echo PHP_EOL;

echo $aquarium . PHP_EOL;
echo $aquarium->getColor() . PHP_EOL;

foreach($aquarium->getFishes() as $fish) {
    echo $fish . PHP_EOL;
    // echo $fish->getName() . PHP_EOL;
}
