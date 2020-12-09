$(document).ready(function() {
    var iCnt = 0;
    $("#country").select2({
    });

    $("#month").select2({
    });

    $("#year").select2({
    });

    $('.dobdatepicker').datepicker({
        format: 'dd-mm-yyyy',
    });
    $('.startdate').datepicker({
        format: 'dd-mm-yyyy',
    });
    $('.enddate').datepicker({
        format: 'dd-mm-yyyy',
    });

    $('#addEnroll').click(function() {
        $('.enddate').datepicker({
            format: 'dd-mm-yyyy',
        });
        $('.startdate').datepicker({
            format: 'dd-mm-yyyy',
        });
    if (iCnt <= 3) {
        iCnt = iCnt + 1;
                    let enrollhtml= '<div class="form-wrap border bg-light py-2r px-25 mt-2r" id="enrollmentPeriode">'+
                    '<h3 class="mb-5">Add Another Enrollment Period</h3>'+
                                '<div class="form-group d-flex mb-2 mt-2r">'+
                                '<label for="">Select your START date of enrollment</label>'+
                                '<div class="row mx-0">'+
                                '<div class="form-row col-sm-3 px-0">'+
                                '<div class="form-group col-md-5">'+
                                   '<p><input type="text" class="form-control startdate" name="startdate"></p>'+
                                    '</div>'+
                               '</div>'+
                                '<div class="info-detail col-sm-9 lato-italic">'+
                                        '<p>Choose August 1 (the first day of the Annual enrollment period), January 1 (the first day of the Second Semester), todays date or another date. This date will appear on your confirmation of enrollment letter. You will be considered enrolled for the full 12-month period for Annual or 7-month period for Second Semester Only.</p>'+
                                '</div>'+
                           '</div>'+
                        '</div>'+
                            '<div class="form-group d-flex mb-2 mt-2r">'+
                                '<label for="">Select your END date of enrollment</label>'+
                                    '<div class="row mx-0">'+
                                        '<div class="form-row col-sm-3 px-0">'+
                                            '<div class="form-group col-md-5">'+
                                            '<p><input type="text" class="form-control enddate" name="enddate"></p>'+
                                            '</div>'+
                                        '</div>'+
                                 '<div class="info-detail col-sm-9 lato-italic">'+
                                        "<p>Choose before July 31 (the last day of your enrollment) or another date before July 31. This date will appear on your confirmation of enrollment letter. Your enrollment will officially end on July 31.</p>"+
                                '</div>'+
                            '</div>'+
                    '</div>'+
                   '<div class="form-group d-flex mb-2 lato-italic info-detail mt-2r">'+
                           '<label for="">Select grade level(s) for your enrollment period'+
                                '<p>(You may select more than one for multiple years)</p></label>'+
                                    '<div class="row pl-5">'+
                                        '<div class="col-sm-3">'+
                                            '<div class="form-check">'+
                                               '<input class="form-check-input" type="radio" name="student_grade" value="Upgraded">'+
                                                    '<label class="form-check-label" for="">'+
                                                        'Upgraded'+
                                                    '</label>'+
                                            '</div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 3">'+
                                                   '<label class="form-check-label" for="">'+
                                                        'Preschool Age 3'+
                                                   '</label>'+
                                            '</div>'+
                               '            <div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 4">'+
                                                    '<label class="form-check-label" for="">'+
                                                        'Preschool Age 4'+
                                                    '</label>'+
                                            '</div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade" value="Kindergarten">'+
                                                    '<label class="form-check-label" for="">'+
                                                        'Kindergarten'+
                                                    '</label>'+
                                            '</div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade" value="1">'+
                                                    '<label class="form-check-label" for="">'+
                                                      '1'+
                                                '</label>'+
                                           ' </div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade" value="2">'+
                                                    '<label class="form-check-label" for="">'+
                                                       '2'+
                                                    '</label>'+
                                            '</div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade" value="3">'+
                                                    '<label class="form-check-label" for="">'+
                                                        '3'+
                                                    '</label>'+
                                            '</div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade" value="4">'+
                                                    '<label class="form-check-label" for="">'+
                                                        '4'+
                                                    '</label>'+
                                            '</div>'+
                                    '</div>'+
                                    '<div class="col-sm-3">'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade" value="5">'+
                                                    '<label class="form-check-label" for="">'+
                                                         '5'+
                                                    '</label>'+
                                            '</div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade" value="6">'+
                                                    '<label class="form-check-label" for="">'+
                                                        '6'+
                                                    '</label>'+
                                            ' </div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade" value="7">'+
                                                    '<label class="form-check-label" for="">'+
                                                        '7'+
                                                    '</label>'+
                                            '</div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade"  value="8">'+
                                                    '<label class="form-check-label" for="">'+
                                                         '8'+
                                                    '</label>'+
                                            '</div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade"  value="9">'+
                                                    '<label class="form-check-label" for="">'+
                                                        '9'+
                                                    '</label>'+
                                            '</div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade"  value="10">'+
                                                    '<label class="form-check-label" for="">'+
                                                        '10'+
                                                    '</label>'+
                                            '</div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade"  value="11">'+
                                                    '<label class="form-check-label" for="">'+
                                                    '11'+
                                                '</label>'+
                                            '</div>'+
                                            '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="student_grade"  value="12">'+
                                                    '<label class="form-check-label" for="">'+
                                                         '12'+
                                                    '</label>'+
                                            '</div>'+
                                    '</div>'+
                                '</div>'+
                                '</div>'+
                        '</div>';
                        // console.log(enrollhtml);
                     $("#enrollmentPeriode").append(enrollhtml);
    }
    else{
            $("#enrollmentPeriode").attr('disabled','disabled');
    }
 });
});

