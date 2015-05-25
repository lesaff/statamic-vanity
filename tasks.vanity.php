<?php
/**
 * Tasks_vanity
 * Statamic CP interface for vanity url redirects
 *
 * @author     Rudy Affandi <rudy@adnetinc.com>
 * @copyright  2015
 * @link       https://github.com/lesaff
 * @license    http://opensource.org/licenses/MIT
 *
 * Versions
 * 1.0.0       Initial release
 */

use Symfony\Component\Finder\Finder as Finder;

class Tasks_vanity extends Tasks {

  public function getVanitySettings() {
    
    $vanity_settings = Config::getConfigPath() . '/vanity.yaml';
    $vanity_yaml = File::get($vanity_settings);
    $vanities = YAML::parse($vanity_yaml);
    $vanity = $vanities;
    return compact('vanity_settings', 'vanity_yaml', 'vanity');

  }
}