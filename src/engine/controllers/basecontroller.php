<?php

namespace App\Controllers;

use App\Extensions;
use Dotenv\Dotenv;

class BaseController
{
    /**
     * The current module
     *
     * @var string|null
     */
    private $module;


    /**
     * The current view
     *
     * @var string|null
     */
    private $view;


    private $mainVariables = array();
    private $templateVariables = array();


    /**
     * The twig environment (= template engine)
     *
     * @var \Twig_Environment
     */
    private $twig;


    /**
     * The main constructor
     *
     * @param string $module The current module
     * @param string $view The current view
     */
    public function __construct($module = null, $view = null)
    {
        if (isset($module)) $this->setModule($module);

        if (isset($view)) $this->setView($view);

        $this->loadSettings();

        $this->loadDatabase();

        $this->loadTemplateEngine();

        $this->setMainVariables();
    }


    /**
     * Load basic settings
     */
    private function loadSettings()
    {
        $pathToConfigurationFile = "./";

        // Check if any configurations are defined
        if (is_file($pathToConfigurationFile . '.env'))
        {
            // Load settings
            $configuration = new Dotenv($pathToConfigurationFile);
            $configuration->load();
        }
        else
        {
            // @todo: display the installation page
            die("Settings do not exist");
        }
        // @todo: fix getenv
    }


    private function loadDatabase()
    {
        // @todo: determine database strategy

        // @todo: establish database connection

        //var_dump(getenv('DB_HOST'));
        //var_dump(getenv('DB_NAME'));
        //var_dump(getenv('DB_USERNAME'));
        //var_dump(getenv('DB_PASSWORD'));
    }


    /**
     * Load the template engine
     */
    private function loadTemplateEngine()
    {
        // Load template directories
        $loader = new \Twig_Loader_Filesystem(
            array(
                './src/assets/templates',
                './src/modules/' . $this->getModule() . '/views',
            )
        );

        // Instantiate a new twig environment with some default settings
        $this->twig = new \Twig_Environment($loader, [
            'cache' => './cache/twig',
            'debug' => true
        ]);

        // Enable debug mode
        $this->twig->addExtension(new \Twig_Extension_Debug());
        //$this->twig->addExtension(new \App\Extensions\TranslationExtension());
    }


    private function setMainVariables()
    {
        $navigation = [
            [
                'url' => '/dashboard',
                'name' => 'Dashboard',
                'icon' => 'ion-home',
                'class' => ''
            ],
            [
                'url' => '/pages',
                'name' => 'Pages',
                'icon' => 'ion-document-text',
                'class' => ''
            ],
            [
                'url' => '/products',
                'name' => 'Catalog',
                'icon' => 'ion-document-text',
                'class' => 'px-open active',
                'subnavigationitems' => [
                    [
                        'url' => '/products',
                        'name' => 'Products',
                        'class' => 'active'
                    ],
                    [
                        'url' => '/products/categories',
                        'name' => 'Categories',
                        'class' => 'active'
                    ],
                    [
                        'url' => '/products/models',
                        'name' => 'Models',
                        'class' => ''
                    ]
                ]
            ],
            [
                'url' => '/users',
                'name' => 'Users',
                'icon' => 'ion-person',
                'class' => ''
            ]
        ];

        $this->assign('navigationitems', $navigation);
    }


    /**
     * Display the website
     */
    protected function render()
    {
        $data = array();

        $data += $this->getTemplateVariables();

        $data += $this->getMainVariables();

        // Render the main template
        $data['Content'] = $this->twig->render($this->getView() . '.twig');

        // Render the page template
        echo $this->getTemplateEngine()->render($this->getView() . '.twig', $data);
    }


    protected function assign($variable, $data)
    {
        $this->templateVariables[$variable] = $data;
    }


    /**
     * Set the active module
     *
     * @param string $module The current module
     */
    public function setModule($module)
    {
        $this->module = $module;
    }


    /**
     * Get the active module
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }


    /**
     * Set the current view
     *
     * @param string $view The current view
     */
    public function setView($view)
    {
        $this->view = $view;
    }


    /**
     * Get the current view
     *
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }


    /**
     * Get the active template engine
     *
     * @return mixed
     */
    protected function getTemplateEngine()
    {
        return $this->twig;
    }


    /**
     * Get the template engine. This is an alias of the 'getTemplateEngine' function
     *
     * @return mixed
     */
    protected function getTwig()
    {
        return $this->getTemplateEngine();
    }


    /**
     * Get the main variables
     *
     * @return array
     */
    protected function getMainVariables()
    {
        return (array)$this->mainVariables;
    }


    /**
     * Get the template variables
     *
     * @return array
     */
    protected function getTemplateVariables()
    {
        return (array)$this->templateVariables;
    }
}