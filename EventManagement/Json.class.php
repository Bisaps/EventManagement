<?php

class Json {
    private $jsonFile = "json_files/events.json";

    public function getRows() {
        if (file_exists($this->jsonFile)) {
            $jsonData = file_get_contents($this->jsonFile);
            $data = json_decode($jsonData, true);
            if (is_array($data)) {
                usort($data, function($a, $b) {
                    return $b['id'] - $a['id'];
                });
                return $data;
            }
        }
        return []; 
    }

    public function getSingle($id) {
        $data = $this->getRows(); 
        foreach ($data as $event) {
            if ($event['id'] == $id) {
                return $event;
            }
        }
        return false;
    }

    public function insert($newData) {
        if (!empty($newData)) {
            $newData['id'] = time();
            $data = $this->getRows(); 
            $data[] = $newData;
            return file_put_contents($this->jsonFile, json_encode($data, JSON_PRETTY_PRINT)) ? $newData['id'] : false;
        }
        return false;
    }

    public function update($upData, $id) {
        if (!empty($upData) && !empty($id)) {
            $data = $this->getRows(); 
            foreach ($data as $key => $event) {
                if ($event['id'] == $id) {
                    $data[$key] = array_merge($event, $upData);
                    return file_put_contents($this->jsonFile, json_encode($data, JSON_PRETTY_PRINT)) !== false;
                }
            }
        }
        return false;
    }

    public function getFilteredRows($filters = array()) {
        $events = $this->getRows();
        return array_filter($events, function($event) use ($filters) {
            $match = true;
            if (!empty($filters['title']) && stripos($event['title'], $filters['title']) === false) {
                $match = false;
            }
            if (!empty($filters['start_date']) && $event['start_date'] < $filters['start_date']) {
                $match = false;
            }
            if (!empty($filters['end_date']) && $event['end_date'] > $filters['end_date']) {
                $match = false;
            }
            return $match;
        });
    }

    public function delete($id) {
        $data = $this->getRows(); 
        $newData = array_filter($data, function($event) use ($id) {
            return $event['id'] != $id;
        });
        return file_put_contents($this->jsonFile, json_encode(array_values($newData), JSON_PRETTY_PRINT)) !== false;
    }
}
?>
