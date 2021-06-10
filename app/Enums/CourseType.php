<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
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
}
