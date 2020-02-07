<?php

class Controller
{
    public function json($data)
    {
        print_r(json_encode($data));
    }

    public function executeModel($config, $page, $model, $arguments = array())
    {
        $file =  '../' . $page . '/php/models/' . $model . '.php';
        if(!file_exists($file))
            return false;
        require_once $file;
        $newModel = new $model($config);
        $newModel->set($arguments);
        $newModel->execute();
        return $newModel->get();
    }

    public function render($page, $data)
    {
        ob_start();
        $view = $data['view'];
        $data = !$this->isNumeric($data['data']) ? array($data['data']) : $data['data'];
        $view_path = '../' . $page . '/php/views/' . $view . '.php';

        if (file_exists($view_path)) {
            foreach ($data as $k => $row) {
                $row = is_array($row) ? $row : array($k => $row);
                foreach ($row as $key => $value) {
                    $$key = $value;
                }
                include $view_path;
            }
        }
        $content = ob_get_contents();

        ob_get_clean();
        return $content;
    }

    private function isNumeric($arr = array())
    {
        if(empty($arr))
            return false;
        foreach (array_keys($arr) as $key){
            if(!is_integer($key)){
                return false;
            }
        }
        return true;
    }

}