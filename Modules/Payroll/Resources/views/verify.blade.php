@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-5 m-auto">
            <h1 class="text-center mt-5" style="font-size: 10em;color: #56565699">
                <i class="fa fa-lock" ></i>
            </h1>
            <p>
                accumulated data, analytics and maintenance algorithms with advanced inspection technologies to provide you actionable intelligence with real-time monitoring and the most precise application of maintenance of way activities. In this new era of digital insight, interval-based maintenance is a thing of the p
            </p>
            <form id="check-password" class="w-100 mr-1 mr-lg-0 mr-md-1 ml-md-1 ml-0 ml-lg-0">
                <div class="form-group">
                    <input type="password" class="form-control height-35 f-14 " id="password" name="password" placeholder="Please enter your password" >
                </div>
                <div class="w-100">
                    <button type="submit" id="submitPassword" class="btn btn-primary w-100">@lang('app.submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '#submitPassword', function () {

            let password = $("#password").val();
            var token = "{{ csrf_token() }}";

            var url = "{{ route('payroll.set_auth_key') }}";
            var goTo = "{{ route($pathToGo) }}"

            $.easyAjax({
                url: url,
                type: 'POST',
                container: '#check-password',
                disableButton: true,
                blockUI: true,
                buttonSelector: "#submitPassword",
                data: {
                    '_token': token,
                    password: password,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Your password is correct",
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                        window.location.replace(goTo);
                    }
                    if (response.status == "error") {
                        Swal.fire({
                            icon: "error",
                            title: "Your password is incorrect",
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    }

                }
            });
        });
    </script>
@endpush
