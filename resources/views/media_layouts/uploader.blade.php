<link rel="stylesheet" href="{{ asset('assets/plugins/uploader/uppy.main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/uploader/uploader.css') }}?t={{ time() }}">
<script type="module" src="{{ asset('assets/plugins/uploader/uppy.main.js') }}"></script>
<div class="offcanvas">
    <div class="canvas-header">
        <h4><?= __('media_files') ?></h4>
        <a href="javascript:;" class="closeManager" onclick="hideMediaManager(this)"><i class="icofont-close-line"></i></a>
    </div>
    <div class="canvas-body">
        <div class="canvasTop">
            <div class="canvasleftTop recentFiles">

                <!-- /.media-warp -->
            </div>
            <div class="canvasrightTop">
                <h3 class="title"><?= __('upload_image') ?></h3>
                <!-- /.title -->
                <div class="uppy-drag-drop-area"></div>
            </div>
            <!-- /.canvasrightTop -->
        </div>
        <!-- /.canvasTop -->
        <div class="canvasBody">
            <div class="bodyHeader">
                <h4 class="title"><?= __('images') ?></h4>
                <!-- /.title -->
                <form id="media-search-from">
                    <div class="rightFilters">
                        <input type="text" name="media-search" class="form-control">
                        <button class="btn btn-default"><i class="fa fa-search"></i> <?= __('search') ?>
                            <!-- /.fa fa-search --></button>
                    </div>
                </form>
                <!-- /.rightFilters -->
            </div>
            <!-- /.bodyHeader -->
            <div class="canvasImages uploadedFiles">

                <!-- /.media-warp -->
            </div>
            <a href="javascript:;" onclick="addSelectedIDs(this)" class="selectedBtn"><i class="fa fa-check"></i>
                <?= lang('select') ?></a>
            <!-- /.canvasbody -->
        </div>

        <!-- /.canvasBody -->
    </div>
    <!-- /.canvas-body -->
    <!-- /.canvas-header -->
</div>
<!-- /.offcanvas -->



<script>
    var PHPLIME = PHPLIME || {};
    let role = `<?= $role ?>`;
    let userId = `<?= $userId ?>`;
    let vendorId = `<?= $vendorId ?>`;
    let uploadUrl = `${base_url}media/save`;
    var browse_images = `<?= __('browse_image') ?>`;
</script>
<script type="module">
    import {
        Uppy,
        Dashboard,
        ImageEditor,
        DropTarget,
        XHRUpload
    } from "<?= asset('assets/plugins/uploader/uppy.main.js') ?>"
    var uppy = new Uppy({
            restrictions: {
                allowedFileTypes: PHPLIME.allowedFileTypes,
            },
            locale: {
                strings: {
                    browse: 'browse',
                    browseFiles: browse_images,
                    cancel: 'cancel',
                    dropHereOr: 'dropHereOr',
                    addMore: 'addMore',
                    chooseFiles: 'chooseFiles',
                    done: 'ok',
                },
            },
            meta: {
                role: role,
                userId: userId,
                vendorId: vendorId,
                '_token': _csrf,
            },
        })
        .use(Dashboard, {
            inline: true,
            target: '.uppy-drag-drop-area',
            proudlyDisplayPoweredByUppy: false,
            hidePauseResumeButton: true,
            width: '100%',
            height: 'auto',

        })
        .use(ImageEditor, {
            target: Dashboard
        })
        // Allow dropping files on any element or the whole document
        .use(DropTarget, {
            target: 'DashboardContainer',

        })

        .use(XHRUpload, {
            headers: {
                "Accept": "application/json",
                '_token': _csrf,
            },

            endpoint: uploadUrl,
            fieldName: "file[]",
            formData: true,

        })

    uppy.on('file-added', (file) => {

    })

    uppy.on('complete', (result) => {
        PHPLIME.isPagination = false;
        getMediaFiles();
    })
</script>

<script>
    "use strict";

    // required
    PHPLIME.getMediaType = 'all';
    PHPLIME.getMediaSearch = '';
    PHPLIME.getUrl = `${base_url}media/show`;
    PHPLIME.isPagination = false;
    PHPLIME.allowedFileTypes = [
        ".png",
        ".svg",
        ".gif",
        ".jpg",
        ".jpeg",
        ".webp"
    ];
    PHPLIME.uploadQty = "single";
    PHPLIME.selectedFiles = null;
    PHPLIME.nextPageUrl = null;
    // required

    // get the media files via ajax
    async function getMediaFiles(search = false) {

        if (search == true) {
            $('.recentFiles').empty();
        }

        $('.previous-uploads').empty();
        var reqData = {};
        if (PHPLIME.isPagination == false) {
            reqData = {
                userId: userId,
                vendorId: vendorId,
                role: role,
                search: search ? PHPLIME.getMediaSearch : '',
            }
        } else {
            reqData = {};
        }


        // get media files
        $.ajax({
            headers: {
                '_token': _csrf
            },
            type: "GET",
            data: reqData,
            dataType: 'json',
            url: PHPLIME.getUrl,
            success: function(json) {

                if (search == false) {
                    $('.recentFiles').html(json.recent_data); // if !searched
                }
                $('.uploadedFiles').html(json.uploaded_data);

                setTimeout(() => {
                    activeSelectedFiles()
                }, 400);

                setTimeout(() => {
                    $('a.selectedBtn').addClass('active');
                }, 1000)
                // initFeather();
            }
        });
    }







    $(document).on('click', '.media-pagination > ul  li a', function(e) {
        e.preventDefault();
        PHPLIME.isPagination = true;
        PHPLIME.getUrl = $(this).attr('href');
        getMediaFiles();
    });



    // show media manager
    async function showMediaManager(thisWrapper) {
        // handle -> click chose file
        $('.offcanvas').addClass('active show');
        $('body').addClass('fixed');

        let selectedFilesInput = $(thisWrapper).find('input');
        PHPLIME.uploadQty = $(thisWrapper).data("selection");
        PHPLIME.selectedFiles = selectedFilesInput.val() != '' ? selectedFilesInput.val() : null;
        PHPLIME.selectedFilesInput = selectedFilesInput;

        PHPLIME.showSelectedFilesDiv = $(thisWrapper).parent();

        await getMediaFiles();
    }

    // add active class to the selected files
    function activeSelectedFiles() {
        if (PHPLIME.selectedFiles != null) {
            PHPLIME.selectedFiles
                .split(",").forEach(selectedImage => {
                    $('[data-id=' + selectedImage + ']').addClass('active-image');
                });
        }
    }

    // on click event handler of files
    function handleSelectedFiles(fileId) {
        $('[data-active-file-id!=' + fileId + ']').removeClass('active-image'); // remove active class
        if (PHPLIME.uploadQty == "single") {
            PHPLIME.selectedFiles = '' + fileId + ''
        } else {
            if (PHPLIME.selectedFiles != null) {
                let tempSelected = PHPLIME.selectedFiles.split(",");

                if (tempSelected.includes('' + fileId + '')) {

                    tempSelected = tempSelected.filter(tempId => {
                        return tempId != '' + fileId + ''
                    })

                    $('[data-id=' + fileId + ']').removeClass(
                        'active-image'); // remove active class

                } else {
                    tempSelected.push(fileId);
                }

                if (tempSelected.length > 0) {
                    PHPLIME.selectedFiles = tempSelected.toString();
                } else {
                    PHPLIME.selectedFiles = null;
                }

            } else {
                PHPLIME.selectedFiles = '' + fileId + ''
            }
        }
        activeSelectedFiles();
    }

    function handleDeleteFiles(fileId) {
        $.ajax({
            headers: {
                '_token': _csrf
            },
            type: "GET",
            data: {
                id: fileId,
            },
            dataType: 'json',
            url: `${base_url}media/delete`,
            success: function(data) {
                if (data.status == 200) {
                    getMediaFiles();
                } else {
                    MSG('error', data.message);
                }
            }
        });

    }
    // show selected files preview after submit selecting files from media manager
    function addSelectedIDs() {
        // for file chosen input counter
        PHPLIME.selectedFilesInput.val(PHPLIME.selectedFiles);
        generatePreview();
        hideMediaManager();
    }

    // show selected file preiview on load in specific pages
    function showSelectedFilePreviewOnLoad() {
        $('.choose-media').each(function() {
            let showSelectedFilesDiv = $(this).parent();
            let selectedFiles = $(this).find('input').val();
            generatePreview(selectedFiles, showSelectedFilesDiv)
        });
    }

    // hide media manager
    function hideMediaManager() {
        $('.offcanvas').removeClass('active show');
        $('body').removeClass('fixed');
        $('a.selectedBtn').removeClass('active');
    }


    // on click event handler of files
    function removeSelectedFile(thisButton, mediaFileId) {
        let removeFileDiv = $(thisButton).closest('.selected-file');
        let showSelectedFilesDiv = removeFileDiv.parent();
        let choseMediaDiv = showSelectedFilesDiv.find('.choose-media');

        let selectedFilesInput = $(choseMediaDiv).find('input');
        let selectedFiles = selectedFilesInput.val();

        if (selectedFiles != null && selectedFiles != '') {
            let tempSelected = selectedFiles.split(",");

            tempSelected = tempSelected.filter(tempId => {
                return tempId != '' + mediaFileId + ''
            })

            $('[data-active-file-id=' + mediaFileId + ']').removeClass('active-image');
            selectedFilesInput.val(tempSelected);
        }
        removeFileDiv.remove();
    }





    // generate preview using IDS for load images after close uploader
    function generatePreview(mediaIds = PHPLIME.selectedFiles, target = PHPLIME.showSelectedFilesDiv) {
        if (mediaIds && mediaIds != '') {
            mediaIds = mediaIds.split(',');
            getSelectedMediaFiles(mediaIds, target); //ajaxload
        }
    }

    // get selected files by IDs after hide media manager
    async function getSelectedMediaFiles(mediaIds, target = PHPLIME.showSelectedFilesDiv) {
        // get media files
        $.ajax({
            headers: {
                '_token': _csrf
            },
            type: "GET",
            data: {
                ids: mediaIds,
            },
            dataType: 'json',
            url: `${base_url}media/select`,
            success: function(data) {
                if (PHPLIME.uploadQty = "single") {
                    target.children().not('.choose-media').remove();
                }

                target.prepend(data.selected_files);
            }
        });
    }



    // media search
    $('#media-search-from').on('submit', function(e) {
        e.preventDefault();
        PHPLIME.getMediaSearch = $('input[name=media-search]').val();
        getMediaFiles(PHPLIME.getMediaSearch != '' ? true : false);
    })
</script>
