<?php

class tendersController extends Controller
{

    public function getData($config)
    {
        $arguments = array(
            'action' => 'get'
        );
        $page = 'tenders';
        $data = array(
            'data' => $this->executeModel($config, $page, 'Data', $arguments),
            'view' => 'get_data'
        );
        $content = !empty($data['data']) ? $this->render($page, $data) : '';
        return $content;
    }

    public function insertData($config, $data)
    {
        $arguments = array(
            'action' => 'insert',
            'data' => $data
        );
        $page = 'tenders';
        $data = array(
            'data' => $this->executeModel($config, $page, 'Data', $arguments),
            'view' => 'get_data'
        );
        $html = $this->render($page, $data);
        $this->json(array(
            'result' => $html ? 'true' : 'false',
            'html' => $html
        ));
        return true;
    }

    public function showUpdateTr($config, $data)
    {
        $arguments = array(
            'action' => 'get',
            'id' => $data['id']
        );
        $page = 'tenders';
        $data = array(
            'data' => $this->executeModel($config, $page, 'Data', $arguments),
            'view' => 'update_data'
        );
        $html = $this->render($page, $data);
        $this->json(array(
            'result' => $html ? 'true' : 'false',
            'html' => $html
        ));
        return true;
    }

    public function updateTender($config, $data)
    {
        $arguments = array(
            'action' => 'update',
            'id' => $data['id'],
            'update' => $data['update']
        );
        $page = 'tenders';
        $data = array(
            'data' => $this->executeModel($config, $page, 'Data', $arguments),
            'view' => 'get_data'
        );
        $html = $this->render($page, $data);
        $this->json(array(
            'result' => $html ? 'true' : 'false',
            'html' => $html
        ));
        return true;
    }

    public function deleteTender($config, $data)
    {
        $arguments = array(
            'action' => 'delete',
            'id' => $data['id'],
        );
        $page = 'tenders';
        $data = array(
            'data' => $this->executeModel($config, $page, 'Data', $arguments),
            'view' => 'get_data'
        );
        $html = $this->render($page, $data);
        $this->json(array(
            'result' => $html ? 'true' : 'false',
            'html' => empty($data['data']) ? '' : $html,
        ));
        return true;
    }

}