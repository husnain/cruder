<?php

namespace Cruder\Sharp;

class Template
{
    public function __construct() 
    {
        // $data = $this->getAllByTable($this->table, $this->select);
        
    }

    public static function render(array $data = array(), $select, $table, $title)
    {
        $str = "<link rel='stylesheet' href='../src/css/bootstrap.min.css'>
        <link rel='stylesheet' href='../src/css/datatables.min.css'>
        <link rel='stylesheet' href='../src/css/buttons.dataTables.min.css'>
        <div class='container'> <table class='table table-striped table-bordered table-hover'>";
        if(!isset($title)){
            $table = str_replace("_", " ", $table);
            $title = ucfirst($table);
        }
        $str .= "<h2>".$title."</h2>";
        $str .= "<thead>";
        $str .= "<tr>";
        foreach($select as $sel){
            $str .= "<th>{$sel}</th>";
        }
        $str .= "<td></td>";
        $str .= "</tr>";
        $str .= "</thead>";

        foreach($data as $key => $value) {
            $str .= "<tr>";
            foreach($select as $sel){
                $str .= "<td>".$value[$sel]."</td>";
            }
            $str .= "<td><i class='fa fa-file'></i><span class='glyphicon glyphicon-search' aria-hidden='true'></span> | Delete</td>";
            $str .= "</tr>";
        }

        $str .= "</table></div>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
        <script src='../src/js/bootstrap.min.js'></script>
        <script src='../src/js/bootstrap.min.js'></script>
        <script src='../src/js/datatables.min.js'></script>
        <script src='../src/js/dataTables.buttons.min.js'></script>
        <script src='../src/js/jszip.min.js'></script>
        <script src='../src/js/pdfmake.min.js'></script>
        <script src='../src/js/vfs_fonts.js'></script>
        <script src='../src/js/buttons.html5.min.js'></script>
        <script src='../src/js/buttons.print.min.js'></script>
        <script src='../src/js/cruder.js'></script>";
        return $str;
    }
}
