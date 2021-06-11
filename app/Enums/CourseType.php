<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CourseType extends Enum
{
    const EnglishCourse =   'English / Language Arts';
    const HistoryCourse =   'History / Social Science';
    const MathsCourse = 'Mathematics';
    const ScienceCourse = 'Science';
    const HealthCourse = 'Health';
    const ForeignCourse = 'Foreign Language';
    const PhysicalEducationCourse = 'Physical Education';
    const AnotherCourse = 'Another';

    // if is_carnagie 1 then not from california
    const NotCaliforniaTotalCredit = 7.25;
    const CaliforniaTotalCredit = 72.5;
}
