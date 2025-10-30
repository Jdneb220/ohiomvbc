<?php

// JSON-backed data helper for ohiomvbc

define('DATA_FILE', __DIR__ . '/data/data.json');

function ensure_data_file_exists_local(){
    $dir = dirname(DATA_FILE);
    if (!is_dir($dir)){
        mkdir($dir, 0755, true);
    }
    if (!file_exists(DATA_FILE)){
        $initial = array(
            'tournaments' => array(),
            'locations' => array()
        );
        file_put_contents(DATA_FILE, json_encode($initial, JSON_PRETTY_PRINT));
    }
}

function load_data_local(){
    static $data = null;
    if ($data !== null) return $data;
    ensure_data_file_exists_local();
    $raw = file_get_contents(DATA_FILE);
    $decoded = json_decode($raw, true);
    if (!is_array($decoded)) {
        $decoded = array('tournaments'=>array(), 'locations'=>array());
    }
    $data = $decoded;
    return $data;
}

function save_data_local($data){
    ensure_data_file_exists_local();
    file_put_contents(DATA_FILE, json_encode($data, JSON_PRETTY_PRINT));
}

function getAllLocations(){
    $data = load_data();
    $locations = isset($data['locations']) ? $data['locations'] : array();
    usort($locations, function($a,$b){ return strcmp($a['Name'],$b['Name']); });
    return $locations;
}

function getTournamentById($id){
    $data = load_data();
    foreach ($data['tournaments'] as $t){
        if (isset($t['ID']) && (string)$t['ID'] === (string)$id) return $t;
    }
    return null;
}

function joinTournamentWithLocation($t){
    $locations = load_data()['locations'];
    foreach ($locations as $loc){
        if (isset($t['Venue']) && isset($loc['Name']) && $t['Venue'] == $loc['Name']){
            $t['Address'] = isset($loc['Address']) ? $loc['Address'] : '';
            if (isset($loc['URL'])) $t['URL'] = $loc['URL'];
            return $t;
        }
    }
    if (!isset($t['Address'])) $t['Address'] = '';
    return $t;
}

function getUpcomingTournaments($limit = null){
    $data = load_data();
    date_default_timezone_set('America/New_York'); 
    $now = date("Y-m-d H:i:s");
    $ts = isset($data['tournaments']) ? $data['tournaments'] : array();
    $filtered = array_filter($ts, function($t) use ($now){
        if (!isset($t['StartDate'])) return false;
        return $t['StartDate'] >= $now;
    });
    usort($filtered, function($a,$b){
        return strcmp($a['StartDate'],$b['StartDate']);
    });
    $result = array();
    foreach ($filtered as $t){
        $result[] = joinTournamentWithLocation($t);
    }
    if ($limit !== null) return array_slice($result, 0, (int)$limit);
    return $result;
}

function getTournamentsThisMonth($limit = null){
    $data = load_data();
    $month = date('n');
    $ts = isset($data['tournaments']) ? $data['tournaments'] : array();
    $filtered = array_filter($ts, function($t) use ($month){
        if (!isset($t['StartDate'])) return false;
        $m = (int)date('n', strtotime($t['StartDate']));
        return $m === (int)$month;
    });
    usort($filtered, function($a,$b){ return strcmp($a['StartDate'],$b['StartDate']); });
    $result = array_map('joinTournamentWithLocation', $filtered);
    if ($limit !== null) return array_slice($result, 0, (int)$limit);
    return $result;
}

// Keep the date formatting helpers for backwards compatibility
function tournamentDateFormat($date){
    $month = substr($date, 5, 2);
    $day = '<span class="day">' . substr($date, 8, 2) . '</span>';
    $year = '<span class="year">, ' .substr($date, 0, 4) . '</span>';
    switch ($month){
        case    '01'    :    $month =    '<span class="month">Jan<span>uary</span></span>'    ; break;
        case    '02'    :    $month =    '<span class="month">Feb<span>ruary</span></span>'    ; break;
        case    '03'    :    $month =    '<span class="month">Mar<span>ch</span></span>'    ; break;
        case    '04'    :    $month =    '<span class="month">Apr<span>il</span></span>'    ; break;
        case    '05'    :    $month =    '<span class="month">May</span>'    ; break;
        case    '06'    :    $month =    '<span class="month">Jun<span>e</span></span>'    ; break;
        case    '07'    :    $month =    '<span class="month">Jul<span>ember</span></span>'    ; break;
        case    '08'    :    $month =    '<span class="month">Aug<span>ust</span></span>'    ; break;
        case    '09'    :    $month =    '<span class="month">Sept<span>ember</span></span>'    ; break;
        case    '10'    :    $month =    '<span class="month">Oct<span>ober</span></span>'    ; break;
        case    '11'    :    $month =    '<span class="month">Nov<span>ember</span></span>'    ; break;
        case    '12'    :    $month =    '<span class="month">Dec<span>ember</span></span>'    ; break;
    }
    echo $month . " " . $day . $year;
}

function tournamentShortDateFormat($date){
    $month = substr($date, 5, 2);
    $day = substr($date, 8, 2);
    $year = substr($date, 0, 4);
    return ltrim($month,'0') . "/" . ltrim($day,'0') . "/" . $year;
}

function tournamentShorterDateFormat($date){
    $month = substr($date, 5, 2);
    $day = substr($date, 8, 2);
    return ltrim($month,'0') . "/" . ltrim($day,'0');
}

function tournamentDayOfTheWeek($date){
    $month = substr($date, 5, 2);
    $day = substr($date, 8, 2);
    $year = substr($date, 0, 4);
    return date("l", mktime(0, 0, 0, $month, $day, $year));
}

// --- Minimal mysql_* compatibility wrappers (read-only for common queries) ---
class JSONResult {
    private $rows;
    private $pos = 0;
    public function __construct($rows){ $this->rows = array_values($rows); }
    public function fetch(){ if ($this->pos >= count($this->rows)) return false; return $this->rows[$this->pos++]; }
    public function num_rows(){ return count($this->rows); }
}

function mysql_query_local($query){
    $q = strtolower($query);
    if (strpos($q, 'select') === 0){
        // tournaments queries
        if (strpos($q, 'from tournaments') !== false){
            $tournaments = load_data()['tournaments'];
            $locations = load_data()['locations'];
            $rows = array();
            foreach ($tournaments as $t){
                $row = $t;
                foreach ($locations as $loc){
                    if (isset($t['Venue']) && isset($loc['Name']) && $t['Venue'] == $loc['Name']){
                        $row['Address'] = isset($loc['Address']) ? $loc['Address'] : '';
                        $row['URL'] = isset($loc['URL']) ? $loc['URL'] : '';
                        break;
                    }
                }
                $rows[] = $row;
            }
            if (preg_match("/startdate >= '([^']+)'/i", $query, $m)){
                $threshold = $m[1];
                $rows = array_filter($rows, function($r) use ($threshold){ if (!isset($r['StartDate'])) return false; return $r['StartDate'] >= $threshold; });
            }
            usort($rows, function($a,$b){ return strcmp($a['StartDate'],$b['StartDate']); });
            if (preg_match("/limit\s+(\d+)/i", $query, $m)){
                $rows = array_slice($rows, 0, (int)$m[1]);
            }
            return new JSONResult($rows);
        }
        // locations
        if (strpos($q, 'from locations') !== false){
            $rows = load_data()['locations'];
            usort($rows, function($a,$b){ return strcmp($a['Name'],$b['Name']); });
            return new JSONResult($rows);
        }
        // calendar-style day extraction
        if (strpos($q, 'day(startdate)') !== false || strpos($q, 'day(startdate)') !== false){
            $rows = array();
            foreach (load_data()['tournaments'] as $t){
                if (!isset($t['StartDate'])) continue;
                $rows[] = array('ID'=>isset($t['ID'])?$t['ID']:null,'d'=> (int)date('j', strtotime($t['StartDate'])));
            }
            return new JSONResult($rows);
        }
        return new JSONResult(array());
    }
    // non-select queries are treated as no-op (return true)
    return true;
}

function mysql_fetch_array_local($res, $mode = MYSQL_ASSOC){ if ($res instanceof JSONResult) return $res->fetch(); return false; }
function mysql_num_rows_local($res){ if ($res instanceof JSONResult) return $res->num_rows(); return 0; }

?>
