   @php
       // for annual years
       $groups = $courses->sortByDesc('type')->split(2);
       $leftGroup = $groups->first()->groupBy('groupBy');
       
       $rightGroup = $groups->last()->groupBy('groupBy');
       
       $leftCount = $leftGroup->count() + $leftGroup->flatten()->count();
       
       $rightCount = $rightGroup->count() + $rightGroup->flatten()->count();
       
       // balance both side items for annual year courses
       
       if ($leftCount < $rightCount) {
           for ($i = 1; $i <= $rightCount - $leftCount; $i++) {
               // push dummy course having -1 id $leftGroup->last()->push((object)['id'=> -1]);
           }
       }
       
       if ($rightCount < $leftCount) {
           for ($i = 1; $i <= $leftCount - $rightCount; $i++) {
               $rightGroup->last()->push((object) ['id' => -1]);
           }
       }
       
   @endphp
   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Transcript pdf</title>
       <style>
           body {
               font-family: "Catamaran", sans-serif;
           }

           table {
               width: 100%;
           }

       </style>
   </head>

   <body>
       <table style="margin-bottom:20px;">
           <tbody>
               <tr style="width:100%;">
                   <td valign="middle"
                       style="text-transform:uppercase;font-weight: 300;font-size:25px;width:50%;height:100px;">official
                       transcript</td>
                   <td valign="middle" style="text-align:center;width:50%;height:100px;">
                       <img src="../public/images/letterhead.png" alt="logo"
                           style="filter: brightness(0.5);max-width: 300px;height:90px;margin: 0 auto;object-fit:contain;display:block;">
                       <!-- <p style="margin:0;font-size:13px;">Califorinia Colorado USA</p>
                               <p style="margin:0;font-size:13px;">949.492.5240 info@westriveracademy.com</p> -->
                   </td>
               </tr>
           </tbody>
       </table>
       <table width="100%" style="margin-bottom:17px;">
       <td width="40%">
       <table>
           <tbody>
               <tr style="width:100%;">
                   <td style="text-transform:uppercase;width:10%;font-size:11px;line-height:1;">Student</td>
                   <td
                       style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:50%;line-height:1;padding-left:30px;">
                       {{ $student->fullname }}
                   </td>
                   </tr>
                   <tr>
                   <td style="text-transform:uppercase;font-size:11px;width:10%;line-height:1;">address</td>
                   <td
                       style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:50%;line-height:1;padding-left:30px;">
                       {{ $address->street_address }} {{ $address->city }}, {{ $address->zip_code }},
                       {{ $address->country }}</td>
                    </tr>
               </tr>
           </tbody>
       </table>
       </td>
       <td width="60%" style="max-width:300px;">
       <table>
           <tbody>
               <tr style="width:100%;">
               <td style="text-transform:uppercase;width:20%;font-size:11px;line-height:1;">Date Of Birth</td>
                   <td
                       style="font-weight:700;text-transform:uppercase;text-align:left;width:20%;font-size:11px;line-height:1;">
                       {{ formatDate($student->d_o_b) }}</td>
                  
                  </tr>
                  <tr>
                   <td style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">academic years</td>
                   <td
                       style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">
                       {{ $minYear }} - {{ $maxYear }}
                   </td>
                   </tr>
                   <tr>
                   <td style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">grade level</td>
                   <td
                       style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">
                       {{ getPromotedGrades($grades_data) }}
                   </td>
                   </tr>
           </tbody>
       </table>
       </td>
       </table>
       <table width="100%" style="border-collapse:collapse;">
           <tbody>
               <tr style="width:100%;">
                   <table style="width:100%;border-collapse:collapse;" border="1">
                       <tr>
                           <td style="width:50%;" valign="top">
                               @include('transcript9to12.courseComponent',[
                               'yearGroup'=> $leftGroup,

                               ])
                           </td>
                           <td style="width:50%;" valign="top">
                               @include('transcript9to12.courseComponent',[
                               'yearGroup'=> $rightGroup,

                               ])
                           </td>
                       </tr>
                   </table>
               </tr>
           </tbody>
       </table>
       <table style="padding-top:20px;vertical-align:top; width:100%;">
           <tr>
               <td style="vertical-align:top;width:35%;">
                   <table width="100%" style="border-collapse:collapse;" border="1">
                       <tr>
                           <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;" width="80%">Total
                               credits earned
                           </th>
                           <td style="padding:3px 5px;font-size:13px;line-height:1;">{{ $totalSelectedGrades }}</td>
                       </tr>
                       <tr>
                           <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;" width="80%">G.P.A
                           </th>
                           <td style="padding:3px 5px;font-size:13px;line-height:1;">
                               {{ getGPAvalue($courses, $totalSelectedGrades) }}</td>
                       </tr>
                       <tr>
                           <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;" width="80%">Date Of
                               Graduation
                           </th>
                           <td style="padding:3px 5px;font-size:13px;line-height:1;">
                               {{ formatDate($dateofGraduation->date_of_graduation) }}
                           </td>
                       </tr>
                   </table>
                   <p style="font-size:13px;">West River Academy is accredited by the National Association for the Legal
                       Support of Alternative Schools (NALSAS) and registered in the California School Directory. CDS
                       Code: 30 66464 6134720 County: Orange Address: 33721 Bluewater Ln. Dana Point, CA 92629-2173</p>
               </td>
               <td style="width:40%;vertical-align:top;padding:0 4px 4px 4px;">
               <table style="border:1px solid #000;" width="100%">
                                    <thead>
                                        <tr>
                                            <th colspan="4"
                                                style="width:100%;text-align:center;font-weight:600;margin-bottom:0;line-height:1.2">
                                                Grading
                                                System </th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="font-size:13px;text-decoration:underline;text-align:center;font-weight:700;">Grade
                                            </td>
                                            <td style="font-size:13px;text-decoration:underline;text-align:center;font-weight:700;">Percent
                                            </td>
                                            <td style="font-size:13px;text-decoration:underline;text-align:center;font-weight:700;">Points
                                            </td>
                                            <td style="font-size:13px;text-decoration:underline;text-align:center;font-weight:700;">AP
                                                Points</td>
                                        </tr>
                                        <tr style="line-height:1;">
                                            <td style="font-size:13px;padding:2px;text-align:center">A</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">90-100</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">4.00</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">5.00</td>
                                        </tr>
                                        <tr style="line-height:1;">
                                            <td style="font-size:13px;padding:2px;text-align:center">B</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">80-89</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">3.00</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">4.00</td>
                                        </tr>
                                        <tr style="line-height:1;">
                                            <td style="font-size:13px;padding:2px;text-align:center">C</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">70-79</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">2.00</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">3.00</td>
                                        </tr>
                                        <tr style="line-height:1;">
                                            <td style="font-size:13px;padding:2px;text-align:center">D</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">60-69</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">1.00</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">2.00</td>
                                        </tr>
                                        <tr style="line-height:1;">
                                            <td style="font-size:13px;padding:2px;text-align:center">F</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">0-59</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">0.00</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">0.00</td>
                                        </tr>
                                        <tr style="line-height:1;">
                                            <td style="font-size:13px;padding:2px;text-align:center">P</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">60-100</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">0.00</td>
                                            <td style="font-size:13px;padding:2px;text-align:center">0.00</td>
                                        </tr>
                                    </tbody>

                                </table>
               </td>
               <td style="width:25%;vertical-align:top;">
                   <table style="width:100%;">
                       <tbody>
                           <tr>
                               <td width="60%" style="text-align:center;width:60%;"><span
                                       style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;">official
                                       signature</span>
                               </td>
                               <td style="width:40%"><span
                                       style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;text-align:center;">date</span>
                               </td>
                           </tr>
                       </tbody>
                   </table>
                   <table style="width:100%;">
                       <tr style="width:100%;">
                           <td style="text-align:center;width:100%;" colspan="2">
                               <div style="margin:0 auto;"><img src="{{ asset('images/Stamp.png') }}"
                                       style="width: 120px;height:120px;object-fit:contain;display:block;" alt="Stamp">
                               </div>
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>
       </table>
   </body>

   </html>
