<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .card {
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-radius: 10px 10px 0 0;
    }

    .form-control,
    .form-select {
        border-radius: 6px;
        padding: 10px 15px;
    }

    .input-group-text {
        border-radius: 0 6px 6px 0;
    }

    body {
        background-color: #e6f2f7;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23bdd6e0' fill-opacity='0.4' fill-rule='evenodd'/%3E%3C/svg%3E");
    }
</style>

<body>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center bg-light">
                        <h2>INQUIRY FORM</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('inquiry.store') }}">
                            @csrf

                            <!-- STUDENT DETAILS -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">STUDENT DETAILS</h5>

                                <div class="mb-3">
                                    <label for="first_name" class="form-label">FIRST NAME</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="middle_name" class="form-label">MIDDLE NAME</label>
                                        <input type="text"
                                            class="form-control @error('middle_name') is-invalid @enderror"
                                            id="middle_name" name="middle_name" value="{{ old('middle_name') }}">
                                        @error('middle_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="surname" class="form-label">SURNAME</label>
                                        <input type="text"
                                            class="form-control @error('surname') is-invalid @enderror" id="surname"
                                            name="surname" value="{{ old('surname') }}" required>
                                        @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="date_of_birth" class="form-label">DATE OF BIRTH</label>
                                        <div class="input-group">
                                            <input type="date"
                                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                                id="date_of_birth" name="date_of_birth"
                                                value="{{ old('date_of_birth') }}" required>
                                            <span class="input-group-text bg-light">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                        @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="gender" class="form-label">GENDER</label>
                                        <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                            name="gender" required>
                                            <option value="" selected disabled>Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>
                                                Other</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row align-items-center mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">ELIGIBLE ADMISSION FOR</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-select @error('admission_type') is-invalid @enderror"
                                            id="admission_type" name="admission_type" required>
                                            <option value="" selected disabled>Select Admission Type</option>
                                            <option value="standard"
                                                {{ old('admission_type') == 'standard' ? 'selected' : '' }}>SYSTEM
                                                SUGGESTED STANDARD</option>
                                            <option value="advanced"
                                                {{ old('admission_type') == 'advanced' ? 'selected' : '' }}>ADVANCED
                                            </option>
                                            <option value="special"
                                                {{ old('admission_type') == 'special' ? 'selected' : '' }}>SPECIAL
                                            </option>
                                        </select>
                                        @error('admission_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">SUITABLE BATCH:</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('batch') is-invalid @enderror"
                                            type="checkbox" id="morning_batch" name="batch[]" value="morning"
                                            {{ is_array(old('batch')) && in_array('morning', old('batch')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="morning_batch">MORNING</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('batch') is-invalid @enderror"
                                            type="checkbox" id="noon_batch" name="batch[]" value="noon"
                                            {{ is_array(old('batch')) && in_array('noon', old('batch')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="noon_batch">NOON</label>
                                    </div>
                                    @error('batch')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- PARENTS DETAILS -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">PARENTS DETAILS</h5>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="father_name" class="form-label">FATHER NAME</label>
                                        <input type="text"
                                            class="form-control @error('father_name') is-invalid @enderror"
                                            id="father_name" name="father_name" value="{{ old('father_name') }}"
                                            required>
                                        @error('father_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="father_phone" class="form-label">PHONE</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input type="text"
                                                class="form-control @error('father_phone') is-invalid @enderror"
                                                id="father_phone" name="father_phone"
                                                value="{{ old('father_phone') }}" required>
                                        </div>
                                        @error('father_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="father_occupation" class="form-label">FATHER'S OCCUPATION</label>
                                    <input type="text"
                                        class="form-control @error('father_occupation') is-invalid @enderror"
                                        id="father_occupation" name="father_occupation"
                                        value="{{ old('father_occupation') }}">
                                    @error('father_occupation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="mother_name" class="form-label">MOTHER NAME</label>
                                        <input type="text"
                                            class="form-control @error('mother_name') is-invalid @enderror"
                                            id="mother_name" name="mother_name" value="{{ old('mother_name') }}"
                                            required>
                                        @error('mother_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="mother_phone" class="form-label">PHONE</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input type="text"
                                                class="form-control @error('mother_phone') is-invalid @enderror"
                                                id="mother_phone" name="mother_phone"
                                                value="{{ old('mother_phone') }}">
                                        </div>
                                        @error('mother_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="mother_occupation" class="form-label">MOTHER'S OCCUPATION</label>
                                    <input type="text"
                                        class="form-control @error('mother_occupation') is-invalid @enderror"
                                        id="mother_occupation" name="mother_occupation"
                                        value="{{ old('mother_occupation') }}">
                                    @error('mother_occupation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="address_line_1" class="form-label">ADDRESS LINE 01</label>
                                    <input type="text"
                                        class="form-control @error('address_line_1') is-invalid @enderror"
                                        id="address_line_1" name="address_line_1"
                                        value="{{ old('address_line_1') }}" required>
                                    @error('address_line_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="address_line_2" class="form-label">ADDRESS LINE 02</label>
                                    <input type="text"
                                        class="form-control @error('address_line_2') is-invalid @enderror"
                                        id="address_line_2" name="address_line_2"
                                        value="{{ old('address_line_2') }}">
                                    @error('address_line_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">CITY</label>
                                        <input type="text"
                                            class="form-control @error('city') is-invalid @enderror" id="city"
                                            name="city" value="{{ old('city') }}" required>
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="state" class="form-label">STATE</label>
                                        <input type="text"
                                            class="form-control @error('state') is-invalid @enderror" id="state"
                                            name="state" value="{{ old('state') }}" required>
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="pin_code" class="form-label">PIN CODE</label>
                                    <input type="text"
                                        class="form-control @error('pin_code') is-invalid @enderror" id="pin_code"
                                        name="pin_code" value="{{ old('pin_code') }}" required>
                                    @error('pin_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- REFERRAL INFO -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">HOW DID YOU COME TO KNOW ABOUT US?</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="newspaper"
                                                name="referral_source[]" value="newspaper"
                                                {{ is_array(old('referral_source')) && in_array('newspaper', old('referral_source')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="newspaper">NEWSPAPER</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="banners"
                                                name="referral_source[]" value="banners"
                                                {{ is_array(old('referral_source')) && in_array('banners', old('referral_source')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="banners">BANNERS</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="reference"
                                                name="referral_source[]" value="reference"
                                                {{ is_array(old('referral_source')) && in_array('reference', old('referral_source')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="reference">REFERENCE</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="social_media"
                                                name="referral_source[]" value="social_media"
                                                {{ is_array(old('referral_source')) && in_array('social_media', old('referral_source')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="social_media">SOCIAL MEDIA</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="tv_ad"
                                                name="referral_source[]" value="tv_ad"
                                                {{ is_array(old('referral_source')) && in_array('tv_ad', old('referral_source')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="tv_ad">TV AD</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="other"
                                                name="referral_source[]" value="other"
                                                {{ is_array(old('referral_source')) && in_array('other', old('referral_source')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="other">OTHER</label>
                                        </div>
                                    </div>
                                </div>
                                @error('referral_source')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- FORM ACTIONS -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-dark px-5 me-2">SAVE</button>
                                <button type="reset" class="btn btn-secondary px-5">RESET</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
    integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $(document).ready(function () {
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>

</html>
