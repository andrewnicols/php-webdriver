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

namespace Facebook\WebDriver\Firefox;

use Facebook\WebDriver\Remote\DesiredCapabilities;

/**
 * The class manages the capabilities in geckodriver.
 *
 * @see https://firefox-source-docs.mozilla.org/testing/geckodriver/Capabilities.html
 */
class FirefoxOptions
{
    /**
     * The key of firefox options in desired capabilities.
     */
    const CAPABILITY = 'moz:firefoxOptions';

    /**
     * @var string
     */
    private $binary = '';

    /**
     * @var array
     */
    private $args = [];

    /**
     * @var array
     */
    private $logLevel = '';

    /**
     * @var array
     */
    private $prefs = [];

    /**
     * @var bool
     */
    private $headless = false;

    /**
     * Sets the path of the Firefox executable. The path should be either absolute
     * or relative to the location running FirefoxDriver server.
     *
     * @param string $path
     * @return FirefoxOptions
     */
    public function setBinary($path)
    {
        $this->binary = $path;

        return $this;
    }

    /**
     * @param array $args
     * @return FirefoxOptions
     */
    public function addArguments(array $args)
    {
        $this->args = array_merge($this->args, $args);

        return $this;
    }

    /**
     * @return DesiredCapabilities The DesiredCapabilities for Firefox with this options.
     */
    public function toCapabilities()
    {
        $capabilities = DesiredCapabilities::firefox();
        $capabilities->setCapability(self::CAPABILITY, $this);

        return $capabilities;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $options = [];
        if ($this->binary) {
            $options['binary'] = $this->binary;
        }

        if ($this->args) {
            $options['args'] = $this->args;
        }

        if ($this->logLevel) {
            $options['log'] = [
                'level' => $this->logLevel,
            ];
        }

        if ($this->prefs) {
            $options['prefs'] = $this->prefs;
        }

        if ($this->headless) {
            if (empty($options['args'])) {
                $options['args'] = [];
            }
            $options['args'][] = '--headless';
        }

        return $options;
    }

    /**
     * Set the log level.
     *
     * @param string $level
     * @return FirefoxOptions
     */
    public function setLogLevel(string $level)
    {
        $this->logLevel = $level;

        return $this;
    }

    /**
     * Add a single preference.
     *
     * @param string $pref
     * @param mixed $value
     * @return FirefoxOptions
     */
    public function addPreference($pref, $value)
    {
        $this->prefs[$pref] = $value;

        return $this;
    }

    /**
     * @param bool $headless
     * @return FirefoxOptions
     */
    public function setHeadless($headless)
    {
        $this->headless = $headless;

        return $this;
    }
}
