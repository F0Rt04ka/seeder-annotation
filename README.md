# Seeder annotation for Laravel tests

Pakcage for loading Laravel seeds from annotations  

### Usage

Add use trait in your TestCase and call load method in setUp()
```php
abstract class AbstractTestCase extends \Orchestra\Testbench\TestCase 
{
    use Fortochka\SeederAnnotation\SeederLoader;
    
    protected function setUp() : void
    {
        //
        //
        $this->loadSeedsFromAnnotations();
    }
}
```

Use `@Seeder` annotation in your test methods
```php
use Fortochka\SeederAnnotation\Seeder;
use YourProjectNamespace\FirstSeeder;
use YourProjectNamespace\SecondSeeder;

/**
 * @Seeder(FirstSeeder::class)
 */
public function testFirst()
{
    //test body
}

/**
 * @Seeder({FirstSeeder::class, SecondSeeder::class})
 */
public function testSecond()
{
    //test body
}
```
