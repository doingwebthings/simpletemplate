<?php

/**
 * Simple Template is a templating class ^^
 */
class Simple_Template
{


    /**
     * base directory for templpate-files
     * @var String
     */
    protected $template_base_dir = 'templates/';


    /**
     * $vars stores the assigned variables so we can get and set them via magic methods
     * @var Array
     */
    protected $vars = array();





    /**
     * creates a Simple_Template object
     *
     * @param String $tpl_dir
     */
    public function __construct($tpl_dir = null)
    {
        if ($tpl_dir !== null)
        {
            $this->template_base_dir = $tpl_dir;
        }
    }





    /**
     * @param $tpl_file String $tpl_file the file to be used as template
     * @param bool $echo
     *
     * @return bool|string
     */
    public function render($tpl_file, $echo = true)
    {
        $output = $this->render_template_to_string($this->template_base_dir . $tpl_file);

        if ($echo === false)
        {
            return $output;
        }
        echo $output;

        return true;
    }





    public function render_template_to_string($tpl_file)
    {
        if (file_exists($tpl_file))
        {
            ob_start();
            include $tpl_file;

            return ob_get_clean();
        }
        else
        {
            return false;
        }
    }





    /**
     * set vars in "template-scope"
     *
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function __set($name, $value)
    {
        $this->vars[$name] = $value;

        return $this;
    }





    /**
     * get template-vars set with __set
     *
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->vars[$name];
    }

}

?>
