<?php

class Data extends Model
{
    private $arguments;
    private $data;

    public function set($arguments)
    {
        $this->arguments = $arguments;
    }

    public function execute()
    {
        switch ($this->arguments['action']) {
            case ('get'):
                $sql = $this->arguments['id'] ?
                    'SELECT * FROM `tenders`
                        WHERE `id` = ' . $this->arguments['id'] . '
                          LIMIT 1' :
                    'SELECT * FROM `tenders`
                        ORDER BY `date` DESC';
                $this->data = db::getInstance()->Select($sql);
                break;
            case ('update'):
                $update = '';
                foreach ($this->arguments['update'] as $col => $value) {
                    $update .= "`" . $col . "` = \"" . $value . "\",";
                }
                $update = trim($update, ',');
                $sql = 'UPDATE `tenders` 
                            SET ' . $update . '
                                WHERE `id` = ' . $this->arguments['id'];
                db::getInstance()->Query($sql);
                $this->arguments['action'] = 'get';
                $this->execute();
                break;
            case ('insert'):
                $cols = "";
                $values = "";
                foreach ($this->arguments['data'] as $col => $value) {
                    $cols .= '`' . $col . '`,';
                    $values .= "\"" . $value . "\",";
                }
                $cols = trim($cols, ',');
                $values = trim($values, ',');
                $sql = 'INSERT INTO `tenders` (' . $cols . ') 
                          VALUES (' . $values . ')';
                db::getInstance()->QueryInsert($sql);
                $this->arguments['action'] = 'get';
                $this->execute();
                break;
            case ('delete'):
                $sql = 'DELETE FROM `tenders` 
                           WHERE `id` = ' . $this->arguments['id'];
                db::getInstance()->Query($sql);
                $this->arguments['action'] = 'get';
                $this->arguments['id'] = false;
                $this->execute();
                break;
        }
        return true;
    }

    public function get()
    {
        return $this->data;
    }
}