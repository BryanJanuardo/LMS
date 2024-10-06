<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CourseCard extends Component
{
    public $courseCode;
    public $credit;
    public $className;
    public $progress;

    public function __construct($courseCode, $credit, $className, $progress)
    {
        $this->courseCode = $courseCode;
        $this->credit = $credit;
        $this->className = $className;
        $this->progress = $progress;
    }

    public function render()
    {
        return view('components.course-card');
    }
}
    