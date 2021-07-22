<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Amplifications\Images\SketchesShemes\SketchesSheme;

class SketchesShemeTest extends TestCase
{

    public function testGet()
    {
        $testSheme = array(
            "xl" => [1280, 720],
            "lg" => [960, 540],
            "md" => [640, 360],
            "sm" => [320, 240],
        );

        $result = SketchesSheme::get();
        $this->assertEquals($testSheme, $result);
    }

    public function testKeys()
    {
        $testKeys = ["xl","lg","md","sm"];

        $result = SketchesSheme::keys();
        $this->assertEquals($testKeys, $result);
    }

    public function testValues()
    {   
        $testValues = [
            [1280, 720],
            [960, 540],
            [640, 360],
            [320, 240]
        ];

        $result = SketchesSheme::values();
        $this->assertEquals($testValues, $result);
    }

    /**
     * @dataProvider providerForFirst
     */ 
    public function testFirst(int $searchValue, array $equalsValue)
    {

        $result = SketchesSheme::first(function($value, $key) use($searchValue) {
            return $value[0] === $searchValue;
        });
        
        $this->assertEquals($equalsValue, $result);
    }

    public function testDivide()
    {   
        $testKeys = ["xl", "lg", "md", "sm"];

        $testValues = [
            [1280, 720],
            [960, 540],
            [640, 360],
            [320, 240]
        ];

        [$keys, $values] = SketchesSheme::divide();
        
        $this->assertEquals($testKeys, $keys);
        $this->assertEquals($testValues, $values);
    }

    /**
     * @dataProvider providerFotOnly
     */
    public function testOnly(array $testKeys, array $equalsValue)
    {
        $result = SketchesSheme::only($testKeys);
        $this->assertEquals($equalsValue, $result);
    }

    public function providerForFirst() {
        return array(
            array(
                1280, // search value
                [1280, 720] // equals value
            ),
            array(
                960, // search value
                [960, 540] // equals value
            ),
            array(
                640, // search value
                [640, 360] // equals value
            ),
            array(
                320, // search value
                [320, 240] // equals value
            ),
        );
    }

    public function providerFotOnly() {
        return array(
            array(
                // input keys list
                ["xl", "md"], 
                // equals value
                [   
                    "xl" => [1280, 720],
                    "md" => [640, 360],
                ] 
            ),
            array(
                // input keys list
                ["xl", "sm"], 
                // equals value
                [   
                    "xl" => [1280, 720],
                    "sm" => [320, 240],
                ] 
            ),
            array(
                // input keys list
                ["xl", "lg"], 
                // equals value
                [   
                    "xl" => [1280, 720],
                    "lg" => [960, 540],
                ] 
            ),
            array(
                // input keys list
                ["md", "sm"], 
                // equals value
                [   
                    "md" => [640, 360],
                    "sm" => [320, 240],
                ] 
            ),
            array(
                // input keys list
                ["lg", "md"], 
                // equals value
                [   
                    "lg" => [960, 540],
                    "md" => [640, 360],
                ] 
            ),
            array(
                // input keys list
                ["xl"], 
                // equals value
                [   
                    "xl" => [1280, 720],
                ] 
            ),
            array(
                // input keys list
                ["md"], 
                // equals value
                [   
                    "md" => [640, 360],
                ] 
            ),
        );
    }

}
