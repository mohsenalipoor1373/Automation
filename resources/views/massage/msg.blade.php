<!--sweet Alert-->
<script src="{{asset('/assets/sweetalert.js')}}"></script>
@if(session()->has('success-message'))
    <script>
        Swal.fire({
            title: 'موفق',
            text: '{{session('success-message')}}',
            icon: 'success',
            confirmButtonText: 'تایید'
        })
    </script>
@endif
@if(session()->has('error-message'))
    <script>
        Swal.fire({
            title: 'اخطار!',
            text: '{{session('error-message')}}',
            icon: 'error',
            confirmButtonText: 'تایید'
        })
    </script>
@endif
@if(session()->has('info-message'))
    <script>
        Swal.fire({
            title: 'توجه!',
            text: '{{session('info-message')}}',
            icon: 'info',
            confirmButtonText: 'تایید'
        })
    </script>
@endif
@if($errors->any())
    <script>
        Swal.fire({
            title: 'خطا!',
            @foreach($errors->all() as $error)
            text: '{{$error}}',
            @endforeach
            icon: 'error',
            confirmButtonText: 'تایید'
        })
    </script>
@endif
