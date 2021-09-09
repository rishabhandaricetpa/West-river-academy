<div class="d-flex">
    <!-- * =============== Sidebar =============== * -->
    @include('layouts.partials.sidebar')
    <!-- * =============== /Sidebar =============== * -->

    <div class="main-content position-relative ml-auto">
        <title> @yield('pageTitle', 'TRANSCRIPT WIZARD') | {{ config('app.name') }}</title>
        <!-- <sup>*</sup> =============== Header =============== <sup>*</sup> -->
        @include('layouts.partials.header')
        <!-- <sup>*</sup> =============== /Header =============== <sup>*</sup> -->

        <!-- * =============== Main =============== * -->

        <main class="position-relative container form-content mt-4 label-styling label-md">
            <h1 class="text-center text-white text-uppercase">TRANSCRIPT WIZARD</h1>
            <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
                <h3 class="mb-3">Select the grade for your high school transcript:</h3>
                <form method="POST" class="mb-0" action="{{ route('enrollSchool', $student_id) }}">
                    @csrf
                    <div class="form-group mb-2 lato-italic info-detail pb-2">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="student_grade" value="9" required>
                            <label class="form-check-label" for="">
                                9
                            </label>
                        </div>
                        <input type="hidden" value="{{ $transcript->id }}" name="transcript_id">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="student_grade" value="10">
                            <label class="form-check-label" for="">
                                10
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="student_grade" value="11">
                            <label class="form-check-label" for="">
                                11
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="student_grade" value="12">
                            <label class="form-check-label" for="">
                                12
                            </label>
                        </div>
                        <div class="col-sm-6 px-0 mt-4">
                            <h3 class="mb-3 mt-4">Where were you enrolled for this grade?</h3>
                            <div class="mb-2 form-check">
                                <input class="form-check-input" type="radio" id="wra_school" name="school_name"
                                    value="West River Academy" required>
                                <label class="form-check-label" for="">
                                    West River Academy
                                </label>
                            </div>
                            <div class="form-check d-sm-flex mb-2 mt-2">
                                <input class="form-check-input" type="radio" id="other_school_name" name="school_name"
                                    value="Others">
                                <label class="form-check-label" for="">
                                    Other: Full Name of School
                                </label>
                                <div>
                                    <input type="text" class="form-control " id="other_school" name="other_school"
                                        autocomplete="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-detail lato-italic">
                        <p>Note: Courses and grades must match exactly the transcript we have on file from the other
                            school.</p>
                    </div>
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
            </div>

            </form>
        </main>
        <!-- * =============== /Main =============== * -->
        @include('layouts.partials.footer')
    </div>

</div>
