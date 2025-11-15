<h3 class="title">{{ __('recently_uploaded') }}</h3>
<div class="media-wrap">
    @foreach ($recent_files as $key => $file)
        <div class="media-item" data-id="<?= $file->id ?>" onclick="handleSelectedFiles({{ $file->id }})">
            <span class="removeImage" data-toggle="tooltip" title="<?= __('delete') ?>"
                onclick="handleDeleteFiles({{ $file->id }})"><i class="fa fa-trash"></i></span>
            <div class="media-img">
                <img src="{{ asset($file->thumb) }}" alt="{{ $file->title }}">
            </div>
            <!-- /.media-img -->
            <div class="media-info">
                <p>{{ $file->title }}</p>
            </div>
            <!-- /.media-info -->
        </div>
    @endforeach

</div>
