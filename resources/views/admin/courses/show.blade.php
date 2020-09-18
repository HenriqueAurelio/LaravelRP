@extends('admin.layouts.app')
@section('content')
    @component('admin.components.show')
        @slot('title', $course->name)
        @slot('form')
            @include('admin.courses.form', ['show' => true])
            <div class="form-group col-12">
                <div class="d-flex justify-content-center">
                <iframe width="560" height="315" src="{{$linkvideo}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        @endslot
    @endcomponent
@endsection


@push('scripts')
    <script>
    $('#description').summernote('disable');
        $('.form-control').attr('readonly',true);
        $(".form-control").attr("disabled", true);
        $('select[value]').each(function () {
            $(this).val($(this).attr('value'));
        });
    </script>
@endpush