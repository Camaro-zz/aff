<?php namespace App\Services;

abstract class BaseService {

    protected $model;

    public function getList($wheres=array(), $offset=null, $limit=null, $sorts=array(), $select=null)
    {
        $query = $this->model->query();
        foreach($wheres as $where) {
            $query->where($where['column'], $where['operator'], $where['value']);
        }
        if(!is_null($select)) {
            $query->addSelect($select);
        }
        if(!is_null($offset)) {
            $query->skip($offset);
        }
        if(!is_null($limit)) {
            $query->take($limit);
        }
        if($sorts){
            foreach($sorts as $sort) {
                $query->orderBy($sort['column'], $sort['direction']);
            }
        }
        return $query->get();
    }

    public function getCount($wheres=array())
    {
        $query = $this->model->query();
        foreach($wheres as $where) {
            $query->where($where['column'], $where['operator'], $where['value']);
        }
        return $query->count();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function insertGetId($data){
        return $this->model->insertGetId($data);
    }

    public function getField($wheres=array(), $field)
    {
        $query = $this->model->query();
        foreach($wheres as $where) {
            $query->where($where['column'], $where['operator'], $where['value']);
        }
        return $query->pluck($field);
    }

    public function get($wheres=array())
    {
        $query = $this->model->query();    
        foreach($wheres as $where) {
            $query->where($where['column'], $where['operator'], $where['value']);
        }
        return $query->first();
    }

    public function update($wheres=array(), $data)
    {
        $query = $this->model->query();
        foreach($wheres as $where) {
            $query->where($where['column'], $where['operator'], $where['value']);
        }
        return $query->update($data);
    }

    public function delete($wheres=array())
    {
        $query = $this->model->query();
        foreach($wheres as $where) {
            $query->where($where['column'], $where['operator'], $where['value']);
        }
        return $query->delete();
    }

    public function batchUpdate($whereIn, $data, $wheres=array())
    {
        $query = $this->model->query();
        foreach($wheres as $where) {
            $query->where($where['column'], $where['operator'], $where['value']);
        }
        $query->whereIn($whereIn['column'], $whereIn['value']);
        return $query->update($data);
    }

    public function setInc($wheres,$column,$step = 1)
    {
        $query = $this->model->query();
        foreach($wheres as $where) {
            $query->where($where['column'], $where['operator'], $where['value']);
        }
        return $query->increment($column, $step);
    }

    public function setDec($wheres,$column,$step = 1)
    {
        $query = $this->model->query();
        foreach($wheres as $where) {
            $query->where($where['column'], $where['operator'], $where['value']);
        }
        return $query->decrement($column, $step);
    }
    
    /**
     *  导出大文件scv
     * 
     *  @author 吴鑫
     */
    public function excelFlushExport($csvHead, $list, $title) {
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        $csv_file = $title . '_' . date('Ymd') . '.csv';
        header('Content-Type: application/vnd.ms-excel;charset=gbk');
        header('Content-Disposition: attachment;filename=' . $csv_file);
        header('Cache-Control: max-age=0');
        $fp = fopen('php://output', 'a');
        foreach ($csvHead as $k => $v) {
            $csvHead[$k] = mb_convert_encoding($v, 'gbk', 'utf-8');
        }
        fputcsv($fp, $csvHead);
        $cnt = 0;
        $limit = 5000;
        foreach ($list as $lv) {
            $cnt++;
            if ($limit == $cnt) {
                ob_flush();
                flush();
                $cnt = 0;
            }
            foreach ($lv as $ik => $iv) {
                $iv = str_replace("\n", "", str_replace("\r", "", $iv));
                if (is_numeric($iv) && strlen($iv) > 11) {
                    $row[$ik] = mb_convert_encoding($iv, 'gbk', 'utf-8') . "\t";
                } else {
                    $row[$ik] = mb_convert_encoding($iv, 'gbk', 'utf-8');
                }
            }
            fputcsv($fp, $row);
        }
    }

}