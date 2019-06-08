<?php
// Copyright 2004-present Facebook. All Rights Reserved.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

namespace Facebook\WebDriver;

/**
 * @coversDefaultClass \Facebook\WebDriver\WebDriverWindow
 */
class WebDriverWindowTest extends WebDriverTestCase
{
    /**
     * @covers ::setSize
     * @covers ::getSize
     * @covers ::__construct
     */
    public function testSizeCanBeFetchedAndAltered()
    {
        $window = $this->driver->manage()->window();
        $window->setSize(new WebDriverDimension(800, 600));

        $size = $window->getSize();
        $this->assertSame(800, $size->getWidth());
        $this->assertSame(600, $size->getHeight());
    }

    /**
     * @covers ::setSize
     * @covers ::getSize
     * @covers ::__construct
     */
    public function testWindowCanBeMaximzed()
    {
        $window = $this->driver->manage()->window();
        $window->setSize(new WebDriverDimension(1, 1));

        $size = $window->maximize();
        $size = $window->getSize();
        $this->assertGreaterThan(1, $size->getWidth());
        $this->assertGreaterThan(1, $size->getHeight());
    }

    /**
     * @covers ::setSize
     * @covers ::getSize
     * @covers ::__construct
     */
    public function testPositionCanBeFetchedAndAltered()
    {
        $window = $this->driver->manage()->window();

        // Set to an initial position.
        $window->setPosition(new WebDriverPoint(0, 0));
        $position = $window->getPosition();
        $this->assertSame(0, $position->getX());
        $this->assertSame(0, $position->getY());

        // Change.
        $window->setPosition(new WebDriverPoint(10, 15));
        $position = $window->getPosition();
        $this->assertSame(10, $position->getX());
        $this->assertSame(15, $position->getY());
    }
}
