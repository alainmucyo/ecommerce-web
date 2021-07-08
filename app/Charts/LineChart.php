<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Echarts\Chart;


class LineChart extends Chart
{
    public function __construct($labels, $data, $title)
    {
        $this->labels($labels);
        $this->dataset($title, "line", $data);
        $this->options(["responsive"=>true]);
        parent::__construct();
    }
}
