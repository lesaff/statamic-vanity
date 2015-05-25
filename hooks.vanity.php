<?php
/**
 * Hooks_vanity
 * CP interface for vanity url redirects
 *
 * @author     Rudy Affandi <rudy@adnetinc.com>
 * @copyright  2015
 * @link       https://github.com/lesaff
 * @license    http://opensource.org/licenses/MIT
 *
 * Versions
 * 1.0.0       Initial release
 */

use Respect\Validation\Validator as v;

class Hooks_vanity extends Hooks {

    public function control_panel__add_to_head(){
        return $this->css->link('vanity');
    }

    public function control_panel__add_routes(){
        $app = \Slim\Slim::getInstance();
        $tasks = $this->tasks;

        $app->get('/vanity', function() use ($app, $tasks) {
            authenticateForRole('admin');
            doStatamicVersionCheck($app);

            $template_list = array("vanity-overview");
            Statamic_View::set_templates(array_reverse($template_list), __DIR__ . '/templates');

            $data = $tasks->getVanitySettings();

            $app->render(null, array('route' => 'vanity', 'app' => $app) + $data);

        })->name('vanity');
        
        
        // Update global vars
        $app->post('/vanity/update', function() use ($app, $tasks) {
            authenticateForRole('admin');
            doStatamicVersionCheck($app);
            
            $action = Request::fetch('action');
            
            $vars = (array) Request::fetch('vars');
            $data = $tasks->getVanitySettings();
            
            $yamlContents = file($data['vanity_settings']);
            //dd($yamlContents);

            foreach($vars as $key => $var) {
                
                //$linesFound = preg_grep($key, $yamlContents);
                $yamlContents =  '' . substr($key,1,-1) . $var . "\n";
            }
            
            file_put_contents($data['vanity_settings'], $yamlContents);

            $app->flash('success', Localization::fetch('update_success'));

            $app->redirect($app->urlFor('vanity'));
        });
    
    }

}