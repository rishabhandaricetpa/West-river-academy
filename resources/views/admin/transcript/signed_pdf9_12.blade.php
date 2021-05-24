   @php
   // for annual years
   $groups = $courses->sortByDesc('type')->split(2);
   $leftGroup = $groups->first()->groupBy('groupBy');

   $rightGroup = $groups->last()->groupBy('groupBy');

   $leftCount = $leftGroup->count() + $leftGroup->flatten()->count();

   $rightCount = $rightGroup->count() + $rightGroup->flatten()->count();

   // balance both side items for annual year courses

   if($leftCount < $rightCount) { for($i=1 ; $i <=($rightCount - $leftCount); $i++){ // push dummy course having -1 id
     $leftGroup->last()->push((object)['id'=> -1]);
     }
     }

     if($rightCount < $leftCount) { for($i=1 ; $i <=($leftCount - $rightCount); $i++) { $rightGroup->
       last()->push((object)['id'=> -1]);
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
               </td>
             </tr>
           </tbody>
         </table>
         <!-- new code starts -->
         <table style="margin-bottom:20px;">
           <tbody>
             <tr>
               <!-- first table -->
               <td style="width:50%">
                 <table>
                   <tbody>
                     <tr>
                       <td valign="top" style="text-transform:uppercase;width:10%;font-size:11px;line-height:1;">Name</td>
                       <td valign="top"
                         style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:50%;line-height:1;">
                         {{$student->fullname}}
                       </td>
                     </tr>
                     <tr>
                       <td valign="top" style="text-transform:uppercase;font-size:11px;width:10%;line-height:1;">address</td>
                       <td valign="top"
                         style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:50%;line-height:1;">
                         {{$address->street_address}}</br> {{$address->city}}, {{$address->zip_code}},
                         {{$address->country}}</td>
                     </tr>
                     <tr>
                       <td  valign="top" style="text-transform:uppercase;font-size:13px;width:10%;"></td>
                       <td valign="top" style="font-weight:700;text-transform:uppercase;text-align:left;font-size:13px;width:50%;">
                       </td>
                     </tr>
                   </tbody>
                 </table>
               </td>
               <!-- second table -->
               <td>
                 <table>
                   <tbody>
                     <tr>
                       <td  valign="top" style="text-transform:uppercase;width:20%;font-size:11px;line-height:1;">Date Of Birth</td>
                       <td valign="top"
                         style="font-weight:700;text-transform:uppercase;text-align:left;width:20%;font-size:11px;line-height:1;">
                         {{$student->d_o_b->format(' M d Y')}}</td>
                     </tr>
                     <tr>
                       <td valign="top" style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">academic years</td>
                       <td valign="top"
                         style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">
                         {{$minYear}} - {{$maxYear}}
                       </td>
                     </tr>
                     <tr>
                       <td valign="top" style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">grade level</td>
                       <td valign="top"
                         style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">
                         {{ getPromotedGrades($grades_data) }}
                     </tr>
                   </tbody>
                 </table>
               </td>
             </tr>
           </tbody>
         </table>
         <!-- new code ends -->

         <table style="border-collapse:collapse; width:100%;">
           <tbody>
             <tr style="width:100%;">
               <table style="width:100%;border-collapse:collapse;" border="1">
                 <tr>
                   <td valign="top" style="width:50%;">
                     @include('transcript9to12.courseComponent',[
                     'yearGroup'=> $leftGroup,

                     ])
                   </td>
                   <td valign="top" style="width:50%;">
                     @include('transcript9to12.courseComponent',[
                     'yearGroup'=> $rightGroup,

                     ])
                   </td>
                 </tr>
               </table>
             </tr>
           </tbody>
         </table>
<!-- new code starts -->

         <table style="padding-top:30px;vertical-align:top; width:100%;">
           <tr>
             <td width="35%" style="vertical-align:top;">
               <table width="100%" style="border:1px solid #ccc;">
                 <tr>
                   <td style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;" width="80%">Total credits
                     earned
                   </td>
                   <td style="padding:3px 5px;font-size:13px;line-height:1;">{{$totalSelectedGrades}}</td>
                 </tr>
                 <tr>
                   <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;" width="80%">G.P.A</th>
                   <td style="padding:3px 5px;font-size:13px;line-height:1;">
                     {{getGPAvalue($courses,$totalSelectedGrades)}}</td>
                 </tr>
                 <tr>
                   <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;" width="80%">Date Of
                     Graduation
                   </th>
                   <td style="padding:3px 5px;font-size:13px;line-height:1;">
                     {{ Carbon\Carbon::parse($dateofGraduation->date_of_graduation)->format('d/m/Y') }}</td>
                 </tr>
               </table>
               <p style="font-size:13px;">West River Academy is accredited by the National Association for the Legal
                 Support of Alternative Schools (NALSAS) and registered in the California School Directory. CDS Code: 30
                 66464 6134720 County: Orange Address: 33721 Bluewater Ln. Dana Point, CA 92629-2173</p>
             </td>
             <td width="45%" style="vertical-align:top;padding:0 4px 4px 4px; border:1px solid #000;">
               <p style="text-align:center;font-weight:600;margin-bottom:0;"><span
                   style="border-bottom:1px solid #000;margin-bottom:0;margin-top:-20px;font-size:13px;">Grading
                   System</span>
               </p>
               <table>
                 <thead>
                   <tr>
                     <th style="font-size:13px;text-decoration:underline;text-align:left;">Grade</th>
                     <th style="font-size:13px;text-decoration:underline;text-align:left;">percent</th>
                     <th style="font-size:13px;text-decoration:underline;text-align:left;">Points</th>
                     <th style="font-size:13px;text-decoration:underline;text-align:left;">AP Points</th>
                   </tr>
                 </thead>
                 <tr>
                   <td style="font-size:13px;">A</td>
                   <td style="font-size:13px;">90-100</td>
                   <td style="font-size:13px;">4.00</td>
                   <td style="font-size:13px;">5.00</td>
                 </tr>
                 <tr>
                   <td style="font-size:13px;">B</td>
                   <td style="font-size:13px;">80-89</td>
                   <td style="font-size:13px;">3.00</td>
                   <td style="font-size:13px;">5.00</td>
                 </tr>
                 <tr>
                   <td style="font-size:13px;">C</td>
                   <td style="font-size:13px;">70-79</td>
                   <td style="font-size:13px;">2.00</td>
                   <td style="font-size:13px;">5.00</td>
                 </tr>
                 <tr>
                   <td style="font-size:13px;">D</td>
                   <td style="font-size:13px;">60-69</td>
                   <td style="font-size:13px;">1.00</td>
                   <td style="font-size:13px;">5.00</td>
                 </tr>
                 <tr>
                   <td style="font-size:13px;">F</td>
                   <td style="font-size:13px;">0-59</td>
                   <td style="font-size:13px;">0.00</td>
                   <td style="font-size:13px;">5.00</td>
                 </tr>
                 <tr>
                   <td style="font-size:13px;">P</td>
                   <td style="font-size:13px;">60-100</td>
                   <td style="font-size:13px;">0.00</td>
                   <td style="font-size:13px;">5.00</td>
                 </tr>
               </table>
             </td>
           </tr>
         </table>
         <!-- new code ends -->

         <!-- <table style="padding-top:30px;vertical-align:top; width:100%;">
           <tr>
             <td width="35%" style="vertical-align:top;">
               <table width="100%" style="border:1px solid #ccc;">
                 <tr>
                   <td style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;" width="80%">Total credits
                     earned
                   </td>
                   <td style="padding:3px 5px;font-size:13px;line-height:1;">{{$totalSelectedGrades}}</td>
                 </tr>
                 <tr>
                   <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;" width="80%">G.P.A</th>
                   <td style="padding:3px 5px;font-size:13px;line-height:1;">
                     {{getGPAvalue($courses,$totalSelectedGrades)}}</td>
                 </tr>
                 <tr>
                   <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;" width="80%">Date Of
                     Graduation
                   </th>
                   <td style="padding:3px 5px;font-size:13px;line-height:1;">
                     {{ Carbon\Carbon::parse($dateofGraduation->date_of_graduation)->format('d/m/Y') }}</td>
                 </tr>
               </table>
               <p style="font-size:13px;">West River Academy is accredited by the National Association for the Legal
                 Support of Alternative Schools (NALSAS) and registered in the California School Directory. CDS Code: 30
                 66464 6134720 County: Orange Address: 33721 Bluewater Ln. Dana Point, CA 92629-2173</p>
             </td>
             <td width="45%" style="vertical-align:top;padding:0 4px 4px 4px; border:1px solid #000;">
               <p style="text-align:center;font-weight:600;margin-bottom:0;"><span
                   style="border-bottom:1px solid #000;margin-bottom:0;margin-top:-20px;font-size:13px;">Grading
                   System</span>
               </p>
               <table>
                 <thead>
                   <tr>
                     <th style="font-size:13px;text-decoration:underline;text-align:left;">Grade</th>
                     <th style="font-size:13px;text-decoration:underline;text-align:left;">percent</th>
                     <th style="font-size:13px;text-decoration:underline;text-align:left;">Points</th>
                     <th style="font-size:13px;text-decoration:underline;text-align:left;">AP Points</th>
                   </tr>
                 </thead>
                 <tr>
                   <td style="font-size:13px;">A</td>
                   <td style="font-size:13px;">90-100</td>
                   <td style="font-size:13px;">4.00</td>
                   <td style="font-size:13px;">5.00</td>
                 </tr>
                 <tr>
                   <td style="font-size:13px;">B</td>
                   <td style="font-size:13px;">80-89</td>
                   <td style="font-size:13px;">3.00</td>
                   <td style="font-size:13px;">5.00</td>
                 </tr>
                 <tr>
                   <td style="font-size:13px;">C</td>
                   <td style="font-size:13px;">70-79</td>
                   <td style="font-size:13px;">2.00</td>
                   <td style="font-size:13px;">5.00</td>
                 </tr>
                 <tr>
                   <td style="font-size:13px;">D</td>
                   <td style="font-size:13px;">60-69</td>
                   <td style="font-size:13px;">1.00</td>
                   <td style="font-size:13px;">5.00</td>
                 </tr>
                 <tr>
                   <td style="font-size:13px;">F</td>
                   <td style="font-size:13px;">0-59</td>
                   <td style="font-size:13px;">0.00</td>
                   <td style="font-size:13px;">5.00</td>
                 </tr>
                 <tr>
                   <td style="font-size:13px;">P</td>
                   <td style="font-size:13px;">60-100</td>
                   <td style="font-size:13px;">0.00</td>
                   <td style="font-size:13px;">5.00</td>
                 </tr>
               </table>
             </td>
           </tr>
         </table> -->
         <table style="margin-top:60px;width:100%;">
           <tr>
             <td style="width:60%;" valign="middle">
               <table style="width:100%;">
                 <tbody>
                   <tr>
                     <td style="text-align:center;width:40%" valign="bottom">
                       <span><img src="../public/images/signature.png" style="width:200px;height:80px;"
                           alt=""></span></br>
                       <span
                         style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;">official
                         signature</span></td>
                     <td style="width:20%;" valign="bottom">
                       <span
                         style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;text-align:center;">date</span>
                     </td>
                   </tr>
                 </tbody>
               </table>
             </td>
             <td style="text-align:center;width:40%;" colspan="2" valign="middle">
               <span style="margin:0 auto;"><img src="../public/images/stamp.png"
                   style="width: 120px;height:120px;object-fit:contain;display:block;" alt="Stamp"></span>
             </td>
           </tr>
         </table>
       </body>

       </html>
