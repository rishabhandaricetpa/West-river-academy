<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CourseType extends Enum
{
    const EnglishCourse =   'English/Language Arts';
    const HistoryCourse =   'History/Social Science';
    const MathsCourse = 'Mathematics';
    const ScienceCourse = 'Science';
    const HealthCourse = 'Health';
    const ForeignCourse = 'Foreign Language';
    const PhysicalEducationCourse = 'Physical Education';
    const AnotherCourse = 'Electives';

    // courses_id
    const EnglishCourseId = 1;
    const HistoryCourseId = 2;
    const MathsCourseId = 3;
    const ScienceCourseId = 4;
    const HealthCourseId = 5;
    const ForeignCourseId = 6;
    const PhysicalEducationCourseId = 7;
    const AnotherCourseId = 8;
}
