<div class="row">
    <div class="form-group col-12">
        <label for="name" class="required">Nome </label>
        <input type="text" name="name" id="name" required class="form-control" autofocus value="{{ old('name', $course->name )}}">
    </div>
    <div class="form-group col-12">
        <label for="client" class="required">Categoria </label>
        <select class="form-control select2" name="category_id" id="category_id" required value="{{ old('category_id', $course->category_id) }}">
            <option></option>
            @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
        <div class="form-group col-12">
            <label for="description" class="required">Descricao</label>
            <textarea name="description" id="description" required class="form-control">{!! $course->description !!}</textarea>
        </div>
    @if(Route::currentRouteName() != 'courses.show')
        <div class="form-group col-12">
            <label for="video" class="required">Link do Video </label>
            <input type="url" name="video" id="video" required class="form-control" autofocus value="{{ old('video', $course->video )}}">
        </div>
        <div class="form-group col-12">
            <input type="file" name="imglink" class="form-control-file" id="imglink" lang="pt-br" accept="image/*" value="{{ old('imglink', $course->imglink) }}">
        </div>
    @endif
    @if(Route::currentRouteName() == 'courses.edit' || Route::currentRouteName() == 'courses.show')
    <div class="form-group col-12">
            <div class="d-flex justify-content-center">
                <img class="img-responsive" width="400" height="400" src="{{ asset('/storage/img/'. $course->imglink) }}" alt="Imagem do curso {{ $course->name }}" />
            </div>
        </div>
    @endif
</div>
@push('scripts')
    <script>
         $('#description').summernote({
            focus: true,
            disableResizeEditor: true,
            height:150,
         });
        $(function(){
            $('.select2').select2();
        })
        $('select[value]').each(function(){
            $(this).val($(this).attr('value'));
        })
      
    </script>
@endpush