@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <button class="btn btn-primary test">click</button>
                <button class="btn btn-success toastBtn">toast</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('foot')
    <script>
        $(".test").click(function (){
            alert("hello");
        })
        $(".toastBtn").click(function(){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Signed in successfully'
            })
        })
    </script>
@endsection
