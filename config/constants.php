<?php

// Global User constants

return [
  'DB_DATE_FORMAT' => 'Y-m-d',
  'EMAILDATEFORMAT' => 'j F Y',

  'ENROLLMENTPERIODS' => ['1' => 'ANNUAL', '2' => 'SEMESTER'],
  'RCERTIFIED' => ['UnderTraining' => 1, 'Invited' => 0, 'Certified' => 2],

  'GRADES' => [
    "9_10" => [9, 10],
    "11_12" => [11, 12],
  ],

  'STUDENT_GRADE' => [
    "Ungraded",
    "Preschool Age 3",
    "Preschool Age 4",
    "Kindergarten",
    "1",
    "2",
    "3",
    "4",
    "5", "6", "7", "8", "9", "10", "11", "12"
  ],
  'CSV_DOMAIN' => 'westriveracademy.com',
  //legends in enrollment-confirmation

  'enrollment_variables' => ['$student_name', '$enrollment_start_date', '$enrollment_end_date'],
  'moneygram' => ['$user_name', '${{', '$amount'],
  'graduation' => ['${{', '$total_fees'],
  'moneyorder' => ['$user_name'],
  'banktransfer' => ['$user_name', '${{', '$amount']
];
