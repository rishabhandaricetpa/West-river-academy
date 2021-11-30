@extends('layouts.app')
@section('pageTitle', 'Preview Transcript9-12')
@section('content')
    <main class="position-relative container form-content mt-4">
        <h1 class="text-center text-white text-uppercase">preview transcript</h1>

        <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
            <p>I'm finished with this transcript. I want to see what it looks like. Submit once done.</p>
            <a href="{{ url('/transcript-pdf') }}" class="btn btn-primary mt-4 font-weight-bold" data-toggle="modal"
                data-target="#previewTranscriptModal">View Transcript</a>
            <a href="{{ route('submit.transcript', [$student->id, $transcript_id]) }}"
                class="btn btn-primary mt-4 font-weight-bold">Submit</a>
        </div>
    </main>
    <div class="modal fade" id="previewTranscriptModal" tabindex="-1" role="dialog"
        aria-labelledby="previewTranscriptModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    @php
                        // for annual years
                        $date = Carbon\Carbon::now()->format('d/m/Y');
                        
                        $groups = $courses->sortByDesc('type')->split(2);
                        $leftGroup = $groups->first()->groupBy('groupBy');
                        
                        $rightGroup = $groups->last()->groupBy('groupBy');
                        
                        $leftCount = $leftGroup->count() + $leftGroup->flatten()->count();
                        
                        $rightCount = $rightGroup->count() + $rightGroup->flatten()->count();
                        
                        // balance both side items for annual year courses
                        
                        if ($leftCount < $rightCount) {
                            for ($i = 1; $i <= $rightCount - $leftCount; $i++) {
                                // push dummy course having -1
                                $leftGroup->last()->push((object) ['id' => -1]);
                            }
                        }
                        
                        if ($rightCount < $leftCount) {
                            for ($i = 1; $i <= $leftCount - $rightCount; $i++) {
                                $rightGroup->last()->push((object) ['id' => -1]);
                            }
                        }
                        
                        $courseGroups = $courses->sortBy('groupBy');
                        
                        $groupList = [];
                        foreach ($courseGroups->toArray() as $key => $groupItem) {
                            $groupList[$groupItem->groupBy][] = $groupItem;
                        }
                        
                        $countGroupItems = count($groupList);
                        if ($countGroupItems > 2 && $countGroupItems % 2 != 0) {
                            $groupList[0] = [];
                        }
                        
                        if (count($groupList)) {
                            $leftGroupItem = [];
                            $rightGroupItem = [];
                            $countGroupItems = round(count($groupList) / 2);
                            $item = 1;
                        
                            foreach ($groupList as $key => $value) {
                                if ($item <= $countGroupItems) {
                                    $leftGroupItem[$key] = $value;
                                } else {
                                    $rightGroupItem[$key] = $value;
                                }
                        
                                $item++;
                            }
                        }
                    @endphp

                    <table style="margin-bottom:20px;" width="100%">
                        <tbody>
                            <tr style="width:100%;">
                                <td width="50%" style="text-transform:uppercase;font-weight: 700;font-size:25px;">official
                                    transcript
                                </td>
                                <td width="50%" style="text-align:center;">
                                    <img src="https://www.westriveracademy.com/cwp/img/wra_logo.svg" alt="logo"
                                        style="filter: brightness(0.5);max-width: 300px;margin: 0 auto;object-fit:contain;display:block;">
                                    <p style="margin:0;font-size:13px;font-weight:700;">California  •  Colorado  •  USA</p>
                                    <p style="margin:0;font-size:13px;font-weight:700;"> 949.456.8753  •  info@westriveracademy.com</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" style="margin-bottom:17px;">
                      <tr>
                      <td style="width:35%;">
                      <table width="100%">
                        <tbody>
                            <tr style="width:100%;">
                                <td style="text-transform:uppercase;width:10%;font-size:11px;line-height:1;">Name</td>
                                <td
                                    style="font-weight:900;text-transform:uppercase;text-align:left;font-size:11px;width:50%;line-height:1;">
                                    {{ $student->fullname }}
                                </td>
                                </tr>
                                <tr>
                                <td style="text-transform:uppercase;font-size:11px;width:10%;line-height:1;">address</td>
                                <td
                                    style="font-weight:900;text-transform:uppercase;text-align:left;font-size:11px;width:50%;line-height:1;">
                                    {{ $address->street_address }} {{ $address->city }}, {{ $address->zip_code }},
                                    {{ $address->country }}</td>
                               </tr>
                          
                        </tbody>
                    </table>
                      </td>
                      <td style="width:55%;">
                      <table width="100%" style="max-width: 300px;">
                        <tbody>
                            <tr style="width:100%;">
                            <td style="text-transform:uppercase;width:20%;font-size:11px;line-height:1;">Date Of Birth
                                </td>
                                <td
                                    style="font-weight:900;text-transform:uppercase;text-align:left;width:20%;font-size:11px;line-height:1;">
                                    {{ formatDate($student->d_o_b) }}</td>
                            </tr>
                            <tr style="width:100%;">
                                <td style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">academic years
                                </td>
                                <td
                                    style="font-weight:900;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">
                                    {{ $minYear }} - {{ $maxYear }}
                                </td>
                            </tr>
                            <tr style="width:100%;">
                                <td style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">grade level
                                </td>
                                <td
                                    style="font-weight:900;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">
                                    {{ getPromotedGrades($grades_data) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                      </td>
                      </tr>
                    </table>
                    <table width="100%" style="border-collapse:collapse;">
                        <tbody>
                            <tr style="width:100%">
                                <table style="width:100%;border-collapse:collapse;" border="1">
                                    <tr>
                                        <td style="width:@php echo $tableWidth;?>" valign="top">
                                            @include('transcript9to12.courseComponent',[
                                            'yearGroup'=> $leftGroupItem,

                                            ])
                                        </td>
                                        @if (count($rightGroupItem))
                                            <td style="width:50%;" valign="top">
                                                @include('transcript9to12.courseComponent',[
                                                'yearGroup'=> $rightGroupItem,

                                                ])
                                            </td>
                                        @endif
                                    </tr>
                                </table>
                            </tr>
                        </tbody>
                    </table>
                    <table style="margin-top:20px;vertical-align:top;width:100%;">
                        <tr>
                            <td style="width:33.3%;vertical-align:top;padding:0 5px;padding-left:0;">
                                <table width="100%" style="border-collapse:collapse" border="1">
                                    <tr>
                                        <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;"
                                            width="80%">Total
                                            credits earned
                                        </th>
                                        <td style="padding:3px 5px;font-size:13px;line-height:1;">
                                            {{ $totalSelectedGrades }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;"
                                            width="80%">G.P.A</th>
                                        <td style="padding:3px 5px;font-size:13px;line-height:1;">
                                            {{ getGPAvalue($courses, $totalSelectedGrades) }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;"
                                            width="80%">Date Of
                                            Transcript
                                        </th>
                                        <td style="padding:3px 5px;font-size:13px;line-height:1;">{{ $date }}</td>
                                    </tr>
                                </table>
                                <p style="font-size:13px;" class="mt-4">West River Academy is accredited by the National
                                    Association
                                    for the Legal Support of Alternative Schools (NALSAS) and registered in the California
                                    School
                                    Directory. CDS Code: 30 66464 6134720 County: Orange Address: 33721 Bluewater Ln. Dana
                                    Point, CA
                                    92629-2173</p>
                            </td>
                            <td style="width:30.3%;vertical-align:top;padding:0 5px;">

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
                            <td style="vertical-align:top;width:36.3%;">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="text-align:center;width:60%;"><span
                                                    style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;">official
                                                    signature</span>
                                            </td>
                                            <td style="width:40%;"><span
                                                    style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;text-align:center;">date</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%">
                                    <tr style="width:100%;">
                                        <td style="text-align:center;width:100%;" colspan="2">
                                            <div style="margin:0 auto;"><img src="{{ asset('images/Stamp.png') }}"
                                                    style="margin:0 auto;width: 100px;height:100px;object-fit:contain;display:block;"
                                                    alt="Stamp"></div>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <table width="100%" class="my-5">
                        <tbody>
                            <tr>
                                <td width="50%" style="text-align:center;position: relative;"> <a
                                        href="{{ route('display.grades', [$student->id, $transcript_id]) }}"
                                        style="background-color: #FC0;line-height:1;color: #000;border: 0;border-radius: 5px;padding: 10px 16px;font-size: 14px;display:inline-block; position: absolute; left:45%;top:10px;">Edit</button>
                                </td>
                                <td width="50%" style="text-align:center;position: relative;"> <a type="submit"
                                        href="{{ route('submit.transcript', [$student->id, $transcript_id]) }}"
                                        style="line-height:1;background-color: #FC0;color: #000;border: 0;border-radius: 5px;padding: 10px 16px;font-size: 14px;display:inline-block; position: absolute; left:42%;top:10px;">Submit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
