(function ($) {
    const loader1 = $('<div class="loader-container"><div class="loader"></div></div>');
    window.MSG = function (type = 'success', msg = '') {
        msg = msg == '' ? successMsg : msg;
        if (getType(type) == 'success') {
            new Notify({
                status: 'success',
                title: 'success',
                text: `${msg}`,
                effect: 'slide',
                speed: 300,
                autoclose: true,
                showCloseButton: true,
                gap: 20,
                distance: 20,
                customClass: 'ci-notify',
                type: 'filled', // or 'filled' outline
                progress: true, // Enable progress bar
                progressDuration: 1000,
            })

        } else if (getType(type) == 'error') {
            new Notify({
                status: 'error',
                title: 'error',
                text: `${msg}`,
                effect: 'slide',
                speed: 300,
                autoclose: true,
                showCloseButton: true,
                gap: 20,
                distance: 20,
                customClass: 'ci-notify',
                type: 'filled', // or 'filled' outline
                progress: true, // Enable progress bar
                progressDuration: 5000,
            })

        }

    };




    /*----------------------------------------------
                 Ajax Message // inline-message
    ----------------------------------------------*/
    window.ajax_msg = function (msg, st) {
        // setTimeout(function(){ $('form').removeClass('submit_form'); jQuery(".ajax_submit").fadeOut()}, 1000);

        //setTimeout(function(){ $(".errorMsg").fadeIn().html(`${msg}`);}, 1000);


        var alertType, heading, icon = '';
        if (st == 1) {
            alertType = 'success';
            heading = 'Success';
            icon = '<i class="icofont-wink-smile"></i>';
        } else if (st == 0) {
            icon = '<i class="icofont-sad"></i>';
            alertType = 'danger';
            heading = 'Sorry';
        } else if (st == 2) {
            icon = '<i class="icofont-info-circle"></i>';
            alertType = 'info';
            heading = 'Info';
        } else if (st == 3) {
            alertType = 'warning';
            heading = 'Warning';
            icon = '<i class="icofont-exclamation-tringle"></i>';
        }

        setTimeout(() => {
            $(".errorMsg").fadeIn().html(`
			<div class="custom_alert alert alert-${alertType} alert-dismissible fade show" role="alert">
				  <strong> ${icon} &nbsp; ${heading}</strong>
				  <div class="msgBody">
				  <div>${msg}</div>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button></div>
				</div>
			`);
            scrollToActiveElement('.errorMsg');
        }, 100);


        setTimeout(() => {
            $('.errorMsg').fadeOut();
        }, 5000);
    }

    function getType(type) {
        if (type == 'success' || type == 1) {
            return 'success';
        } else if (type == 'error' || type == 0) {
            return 'error';
        } else if (type == 'warning' || type == 2) {
            return 'warning';
        } else if (type == 'info' || type == 3) {
            return 'info';
        } else {
            return 'error';
        }

    }

    window.scrollToActiveElement = function (className) {
        const activeElement = document.querySelector(className);

        if (activeElement) {
            activeElement.scrollIntoView({
                behavior: 'smooth'
            });
        }
    };


    // // check addtocart validation
    // window.extraValidation = function () {
    //     let isValid = true;

    //     $('.item_extra_list.required-section').each(function () {
    //         var section = $(this);
    //         var requiredCount = parseInt(section.data('limit'));
    //         var inputs = section.find('input.itemExtras:checked');
    //         console.log(requiredCount, inputs.length);
    //         if (inputs.length < requiredCount) {
    //             isValid = false;
    //             section.find('.errorMessage').text(`${select_at_least} ${requiredCount} ${options}`);
    //             scrollToActiveElement('.errorMessage');
    //         } else {
    //             section.find('.errorMessage').text('');
    //         }
    //     });

    //     setTimeout(() => {
    //         $('.errorMessage').html('');
    //     }, 4000);

    //     return isValid;
    // }



    /*----------------------------------------------
                      Default sumitter
    ----------------------------------------------*/

    window.formSubmit = function (event, thisForm) {
        event.preventDefault();

        const formData = new FormData(thisForm);
        const endpointUrl = thisForm.action;
        const csrfToken = thisForm.querySelector('input[name="_token"]').value;
        let formBtn = $(thisForm).find('[type="submit"]');

        submitBtn(formBtn, true);

        const progressBarContainer = $('<div class="ci-progress-bar" style="width: 99%; background-color: #f3f3f3; margin-bottom: 5px;"></div>');
        const progressBar = $('<div class="progress-bar" style="width: 0%; height: 5px; background-color: #4CAF50; transition: width 0.3s;"></div>');
        const progressText = $('<div class="progress-text" style="text-align: center; font-size: 12px;"></div>');
        progressBarContainer.append(progressBar, progressText);


        $(thisForm).prepend(progressBarContainer);

        if ($(thisForm).find('.errorMsg').length == 0) {
            $(thisForm).prepend('<span class="errorMsg"></span>');
        }

        let uploadProgress = 0;

        const updateProgress = (progress) => {
            console.log(`Progress: ${progress}%`);
            progressBar.css('width', `${progress}%`);
            progressText.text(`${progress}%`);
        };

        axios.post(endpointUrl, formData, {
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            onUploadProgress: function (progressEvent) {
                if (progressEvent.total) {
                    // Calculate upload progress, but cap it at 95%
                    uploadProgress = Math.min(95, Math.round((progressEvent.loaded / progressEvent.total) * 100));
                    updateProgress(uploadProgress);
                }
            }
        })
            .then(function (response) {
                updateProgress(100); // Set to 100% only when the response is received

                response = response.data;

                if (response.st == 1 || response.success == true) {
                    MSG(response.st, response.msg);
                    setTimeout(() => {
                        if ($(thisForm).hasClass('formSubmit')) {
                            submitBtn(formBtn, false);
                            progressBarContainer.remove();
                        } else {
                            if ($('.alert_msg').length == 0) {
                                $(thisForm).after('<span class="alert_msg"></span>');
                            }
                            $('.defaultSidebar > .title').text('');
                            $('.defaultSidebar > .sidebarContent').html('');
                            $('.defaultSidebar, .sidebar-footer').removeClass('active');
                            $('body').removeClass('sidebar-open');
                        }

                        if ($('.customModal').length > 0) {
                            $('.customModal').modal('hide');
                        }
                    }, 2000);

                    $(thisForm)[0].reset();


                    setTimeout(() => {
                        if (response.url == '' || response.url == null || response.url == undefined) {
                            return false;
                        } else if (typeof response.url === "object") {
                            $(`#${response.url.modalName}`).modal('show');
                            $('.modalContent').html(response.url.result);
                        } else if (response.url === '1' || response.url == 1 || response.url == true || response.url == 'true' || response.url == 'reload') {
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else if (isAjaxRequest(response.url)) {
                            load_by_url(response.url);
                            console.log(response.url);
                        } else {
                            setTimeout(() => {
                                window.location = response.url;
                            }, 2000);
                        }
                    }, 500);

                } else {
                    ajax_msg(response.msg, response.st);
                    scrollToActiveElement('.errorMsg');

                }

                setTimeout(() => {
                    submitBtn(formBtn, false);
                    progressBarContainer.remove();
                }, 2000);
            })
            .catch(function (error) {
                console.error('Error:', error);
                updateProgress(0); // Reset progress on error
                const errorMessage = error.response ? error.response.data : 'An error occurred.';
                ajax_msg(errorMessage, 0);

                setTimeout(() => {
                    submitBtn(formBtn, false);
                    progressBarContainer.remove();
                }, 2000);
            });
    };

    /*----------------------------------------------
     hold for not uploading image
    ----------------------------------------------*/
    window.formSubmit__ = function (event, thisForm) {
        event.preventDefault();


        const formDataSerialized = $(thisForm).serialize();


        // const formData = new FormData(thisForm);
        const endpointUrl = thisForm.action;
        const csrfToken = thisForm.querySelector('input[name="_token"]').value;


        let formBtn = $(thisForm).find('[type="submit"]');

        submitBtn(formBtn, true);

        const progressBarContainer = $('<div class="ci-progress-bar"></div>');
        const progressBar = $('<progress class="progress" max="100" value="0"></progress>');
        progressBarContainer.append(progressBar);
        $(thisForm).prepend(progressBarContainer);
        progressBarContainer.css('display', 'flex');


        if ($(thisForm).find('.errorMsg').length == 0) {
            $(thisForm).prepend('<span class="errorMsg"></span>');
        }


        axios.post(endpointUrl, formDataSerialized, {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            onUploadProgress: function (progressEvent) {
                const progress = Math.round((progressEvent.loaded / progressEvent.total) * 100);
                progressBar.val(progress);
            }
        })
            .then(function (response) {
                response = response.data;
                if (response.st == 1 || response.success == true) {

                    MSG(response.st, response.msg);
                    setTimeout(() => {
                        if ($(thisForm).hasClass('formSubmit')) {
                            submitBtn(formBtn, false);
                            progressBarContainer.css('display', 'none');
                            progressBarContainer.remove();
                        } else {
                            if ($('.alert_msg').length == 0) {
                                $(thisForm).after('<span class="alert_msg"></span>');
                            }
                            $('.defaultSidebar > .title').text('');
                            $('.defaultSidebar > .sidebarContent').html('');
                            $('.defaultSidebar, .sidebar-footer').removeClass('active');
                            $('body').removeClass('sidebar-open');
                        }

                        if ($('.customModal').length > 0) {
                            $('.customModal').modal('hide');
                        }

                    }, 2000);


                    $(thisForm)[0].reset();


                    setTimeout(() => {
                        if (response.url == '' || response.url == null || response.url == undefined) {
                            return false;
                        } else if (response.url === '1' || response.url === 'true') {
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else if (isAjaxRequest(response.url)) {
                            load_by_url(response.url);
                            console.log(response.url)
                        } else {
                            console.log(response.url);
                            setTimeout(() => {
                                window.location = response.url;
                            }, 2000);
                        }
                    }, 500);

                    if ($('.singeSelect').length > 0) {
                        initslectr();
                    }

                } else {
                    ajax_msg(response.msg, response.st);

                    scrollToActiveElement('.errorMsg');
                }

                setTimeout(() => {
                    submitBtn(formBtn, false);
                    progressBarContainer.css('display', 'none');
                    progressBarContainer.remove();
                }, 2000);
            })
            .catch(function (error) {
                console.error('Error:', error);
                const errorMessage = error.response ? error.response.data : 'An error occurred.';
                ajax_msg(errorMessage, 0);

                setTimeout(() => {
                    submitBtn(formBtn, false);
                    progressBarContainer.css('display', 'none');
                    progressBarContainer.remove();
                }, 2000);
            });
    };


    /*----------------------------------------------
     load_by_url
    ----------------------------------------------*/
    window.load_by_url = function (url) {

        axios.get(url)
            .then(function (response) {
                setTimeout(() => {
                    $('#mainContent').html(response.data);
                }, 2000);
            })
            .catch(function (error) {
                console.error('Error loading order type settings:', error);
            });
    }


    function initslectr() {
        new Selectr('.singeSelect', {
            renderOption: myRenderFunction,
            multiple: false,
            customClass: 'customSelect-2'
        });

        function myRenderFunction(option) {
            var template = [
                "<div class='selectImg'><img src='", option.dataset.src, "'><span>",
                option.textContent,
                "</span></div>"
            ];
            return template.join('');
        }

        function updateFlag(select) {

            var selectedOption = select.options[select.selectedIndex];
            var flagUrl = selectedOption.dataset.src;
            select.style.backgroundImage = "url('" + flagUrl + "')";
        }
    }


    /*----------------------------------------------
                 Default sidebar
    ------------------------------------------------*/
    // Function to initialize sidebar
    window.sidebar = function (sidebarClass) {
        var sidebarClassSelector = `.${sidebarClass}.sidebar-modal`;
        var heading = $(sidebarClassSelector + ' > .heading').text();
        var content = $(sidebarClassSelector + ' > .sidebar-content').html();

        $('.defaultSidebar .sidebarWrapper > .sidebar_header > .title').text(heading);
        $('.defaultSidebar .sidebarWrapper > .sidebarContent').html(content);
        $('.defaultSidebar').addClass('active');

        setTimeout(() => {
            sidebarInit();
            document.body.classList.add('sidebar-open');
        }, 100);

    };


    function sidebarInit() {
        $(".defaultSidebar .select-2").select2();
        if ($('.defaultSidebar .sidebarSelect').length > 0) {
            new Selectr('.defaultSidebar .sidebarSelect', {
                renderOption: myRenderFunction,
                multiple: false,
                customClass: 'customSelect'
            });
        }

        $('.dataTextarea').summernote({
            height: 100,
            codemirror: { // codemirror options
                theme: 'monokai',
                mode: 'text/html',
                lineNumbers: true,
                htmlMode: true,
            },
            toolbar: [
                ['font', ['bold', 'italic', 'underline', 'clear']],
            ],


        });



    }
    function myRenderFunction(option) {
        var template = [
            "<div class='selectImg'><img src='", option.dataset.src, "'><span>",
            option.textContent,
            "</span></div>"
        ];
        return template.join('');
    }


    window.updateFlag = function (select) {
        var selectedOption = select.options[select.selectedIndex];
        var flagUrl = selectedOption.dataset.src;
        select.style.backgroundImage = "url('" + flagUrl + "')";
    }


    window.changeStatus = function (event, setData, id, status, table) {
        event.preventDefault();


        var currentStatus = $(setData).data('status');
        var newStatus = 1 - currentStatus;
        var endpointUrl = addLangToUrl(`${base_url}admin/auth/change_status`);


        var postData = {
            'id': id,
            'status': newStatus,
            'table': table,
            '_token': _csrf // Ensure _csrf is defined globally
        };

        // Changed to POST request
        $.post(endpointUrl, postData, function (json) {
            if (json.st == 1) {
                if (json.value == 0) {
                    $(setData).data('status', 0);
                    $(setData).html(`<i class="fa fa-ban"></i>&nbsp; ${deactivated}`)
                        .removeClass('badge-success')
                        .addClass('badge-danger');
                    MSG(false, item_deactivated);
                } else {
                    $(setData).data('status', 1);
                    $(setData).html(`<i class="fa fa-check"></i>&nbsp; ${activated}`)
                        .removeClass('badge-danger')
                        .addClass('badge-success');
                    MSG(true, item_activated);
                }
            }
        }, 'json').fail(function (jqXHR, textStatus, errorThrown) {
            console.error("Request failed: " + textStatus, errorThrown);
        });
    };


    /*----------------------------------------------
           submit button loading/unloading
    ----------------------------------------------*/
    window.submitBtn = function (currentBtn, type) {

        if (type == true) {
            currentBtn.prop('disabled', true);
            currentBtn.addClass('btn-loading');
        } else {
            currentBtn.prop('disabled', false);
            currentBtn.removeClass('btn-loading');
        }
    }


    /*----------------------------------------------
              Hide sidebar
       ----------------------------------------------*/
    window.hideSidebar = function () {
        console.log('object');

        if ($('.alert_msg').length == 0) {
            $(this).after('<span class="alert_msg"></span>');
        }
        $('.defaultSidebar > .title').text('');
        $('.defaultSidebar > .sidebarContent').html('');
        $('.defaultSidebar, .sidebar-footer').removeClass('active');
        document.body.classList.remove('sidebar-open');
    }

    window.statusDiv = function ($this, className) {
        if ($($this).is(':checked')) {
            $('.' + className).slideDown();
        } else {
            $('.' + className).slideUp();
        }

    }


    window.toggleClass = function ($this, className) {
        $('.' + className).slideToggle();

    }

    /*----------------------------------------------
          GET LATITUDE & LONGITUDE
    ----------------------------------------------*/

    window.getLocation = function () {

        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                if ($('[name="latitude"]').length > 0) {
                    $('[name="latitude"]').val(latitude);
                }

                if ($('[name="longitude"]').length > 0) {
                    $('[name="longitude"]').val(longitude);
                }
                console.log("Latitude: " + latitude + ", Longitude: " + longitude);
            }, function (error) {
                console.error("Error getting geolocation:", error);
            });
        } else {
            console.error("Geolocation is not supported by this browser.");
        }
    }

    /*----------------------------------------------
                Show div / toggle div
    ----------------------------------------------*/
    window.showDiv = function ($this, className) {
        if ($($this).is(':checked')) {
            $($this).closest('.form-group').find('.' + className).slideDown();
        } else {
            $($this).closest('.form-group').find('.' + className).slideUp();
        }
    }

    window.toggleDiv = function ($this, className, inverse = false) {
        if (inverse == true) {
            if ($($this).is(':checked')) {
                $('.' + className).slideDown();
            } else {
                $('.' + className).slideUp();
            }
        }

        if (inverse == true) {
            if ($($this).is(':checked')) {
                $('.' + className).slideUp();
            } else {
                $('.' + className).slideDown();
            }
        }

    }


    function isAjaxRequest(url) {
        return url.indexOf('?isAjax=1') !== -1;
    }




    window.scrollToActiveElement = function (className) {
        const activeElement = document.querySelector(className);

        if (activeElement) {
            activeElement.scrollIntoView({
                behavior: 'smooth'
            });
        }
    };




    /*----------------------------------------------
     GLOBAL REQUEST
    ----------------------------------------------*/

    window.getRequest = function (URL, isLoader = true) {
        // Create and show the loader
        if (isLoader) {
            loader1.appendTo('body');
        }


        const config = {
            headers: {
                'X-CSRF-TOKEN': _csrf,
                'X-Requested-With': 'XMLHttpRequest'
            }
        };

        return axios.get(URL, config)
            .then(function (response) {
                return response.data; // Return the response data
            })
            .catch(function (error) {
                console.error('Error fetching data:', error);
                console.warn('Error fetching data. Please try again.');
                throw error; // Re-throw the error to propagate it
            })
            .finally(function () {
                // Hide and remove the loader
                setTimeout(() => {
                    if (isLoader) {
                        loader1.remove();
                    }
                }, 200);
            });
    }

    /*----------------------------------------------
     For get request
    ----------------------------------------------*/
    window._request = function (event, thisForm, method = 'GET', redirectUrl = 'this') {

        event.preventDefault();
        const baseUrl = $(thisForm).attr('action'); // Get form action URL
        const formData = new FormData(thisForm); // Create FormData object from form

        // Construct URL with parameters
        let url = new URL(baseUrl, window.location.origin);
        let params = new URLSearchParams();

        // Iterate over form data and append to params
        for (let [key, value] of formData.entries()) {
            params.append(key, value);
        }


        if (method === 'GET') {
            params.append('isAjax', '1');
        }


        // Append params to URL
        url.search = params.toString();

        const fullUrl = url.toString();

        // Show the loader (if applicable)
        loader1.appendTo('body');

        // Request configuration for axios
        const config = {
            method: method,
            url: fullUrl, // Use the full URL with parameters
            headers: {
                'X-CSRF-TOKEN': _csrf, // CSRF protection
                'X-Requested-With': 'XMLHttpRequest'
            }
        };

        if (method !== 'GET') {
            config.data = formData; // Use FormData object for POST requests
            config.headers['Content-Type'] = 'multipart/form-data'; // Automatically set by Axios
        }

        axios(config)
            .then(function (response) {

                if (redirectUrl && (redirectUrl.includes('#') || redirectUrl.includes('.'))) {

                    $(redirectUrl).html(response.data.result);
                }

                else if (redirectUrl && redirectUrl !== '' && redirectUrl != 'this') {
                    load_by_url(redirectUrl);
                }

                else {
                    $('#mainContent').html(response.data);
                }

                if ($('.filterForm').length) {
                    $('.filterForm').slideDown();
                }
                if ($('[name="daterange"]').length) {
                    setTimeout(() => {
                        daterangeInit();
                    }, 200);
                }


                lazyLoad();

            })
            .catch(function (error) {
                console.error('Error fetching data:', error);
                console.warn('Error fetching data. Please try again.');
            })
            .finally(function () {
                // Remove the loader after request completes
                setTimeout(() => {
                    loader1.remove();
                }, 200);
            });

        return false; // Ensure form submission does not proceed
    };



    /*----------------------------------------------
     GET REQUEST
    ----------------------------------------------*/
    window._getRequest = function (url, method = 'POST', data = {}) {
        loader1.appendTo('body');

        let config = {
            method: method,
            url: url,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': _csrf
            }
        };

        if (method === 'GET') {
            const params = new URLSearchParams(data).toString();
            config.url = params ? `${url}?${params}` : url;
        } else {
            const params = new URLSearchParams();
            for (const key in data) {
                if (data.hasOwnProperty(key)) {
                    params.append(key, data[key]);
                }
            }
            config.data = params.toString();
            config.headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        return axios(config)
            .then(function (response) {
                return response.data;
            })
            .catch(function (error) {
                console.error('Error fetching data:', error);
                console.warn('Error fetching data. Please try again.');
                throw error;
            })
            .finally(function () {
                loader1.remove();
            });
    }








    window.ci_radio = function ($this, commonClass = '', className = '') {
        var name = $($this).attr('name');

        $('input[name="' + name + '"]').each(function () {
            $(this).prop('checked', false);
            $(this).closest('label').removeClass('active');
        });
        $($this).prop('checked', true);
        $($this).closest('label').addClass('active');

        if (commonClass.trim() !== '') {
            $(`.${commonClass}`).slideUp();

            if (className.trim() !== '') {
                $(`.${className}`).slideDown();
            }
        }

    };

    /*----------------------------------------------
        PRINT INVOICE
    ----------------------------------------------*/

    window.print = function (printDiv = 'printArea') {
        var printContent = document.getElementById(printDiv).innerHTML;

        // Create a hidden iframe
        var iframe = document.createElement('iframe');
        iframe.style.display = 'none';
        document.body.appendChild(iframe);

        var styles = Array.from(document.styleSheets)
            .map(styleSheet => {
                try {
                    return Array.from(styleSheet.cssRules)
                        .map(rule => rule.cssText)
                        .join('');
                } catch (e) {
                    console.log('Access to stylesheet blocked:', styleSheet.href);
                    return '';
                }
            })
            .join('\n');

        iframe.contentDocument.write(`
        <html>
            <head>
                <title>Print</title>
                <style>
                    ${styles}
                    @media print {
                        body { visibility: visible; }
                    }
                    @page { size: auto; margin: 0mm; }
                </style>
            </head>
            <body>
                <div class="receipt">${printContent}</div>
            </body>
        </html>
    `);
        iframe.contentDocument.close();

        setTimeout(function () {
            iframe.contentWindow.print();

            setTimeout(function () {
                document.body.removeChild(iframe);
            }, 1000);
        }, 500);
    }


    /*----------------------------------------------
     Export as pdf
    ----------------------------------------------*/
    window.exportPDF = function (button, printDiv = 'printArea') {
        var section = document.getElementById(printDiv);

        var orderId = $(button).data('id');
        if (orderId) {
            var options = {
                padding: .2,
                filename: 'order_' + orderId + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };

            html2pdf().set(options).from(section).save();
        } else {
            console.error('data-id attribute is missing from the button.');
        }
    }


    window.shouldAddLangParameter = function () {
        return true;
    }







    $(document).ready(function () {
        $('.checkoutWrapper input[type="radio"]:checked').closest('label').addClass('active');
    });

    /*----------------------------------------------
     init date range
    ----------------------------------------------*/
    window.daterangeInit = function () {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            setDate: '',
            startDate: moment().startOf('hour').subtract(64, 'hour'),
            endDate: moment().startOf('hour'),
            locale: {
                cancelLabel: 'Clear',
                format: 'D MMM YYYY'
            },
            autoUpdateInput: false,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            },
        }, function (start, end, label) {
            console.log("A new date selection was made: " + start.format('MMMM D, YYYY') + ' to ' + end.format('MMMM D, YYYY'));
        });

        $('input[name="daterange"]').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('D MMM YYYY') + ' - ' + picker.endDate.format('D MMM YYYY'));
        });
        $('input[name="daterange"]').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
    };



    /*----------------------------------------------
     LAZY LOADER
    ----------------------------------------------*/

    $(window).on('load', function () {
        function isInViewport(element) {
            var rect = element.getBoundingClientRect();
            var buffer = 3000;
            return (
                rect.top >= -buffer &&
                rect.left >= -buffer &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) + buffer &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth) + buffer
            );
        }

        // Function to load background images
        function loadBackgroundImage(element) {
            var $element = $(element);
            var src = $element.data('src');
            if (src) {
                $element.css("background-image", "url(" + src + ")");
                $element.removeAttr('data-src');
                $element.removeClass('bg_loader');
            }
        }

        // Function to load <img> tag images
        function loadImage(element) {
            var $element = $(element);
            var src = $element.data('src');
            if (src) {
                $element.attr('src', src);
                $element.removeAttr('data-src');
                $element.removeClass('img_loader');
            }
        }

        // Function to handle lazy loading
        window.lazyLoad = function () {
            $('.bg_loader, .img_loader').each(function () {
                if (isInViewport(this)) {
                    if ($(this).hasClass('bg_loader')) {
                        loadBackgroundImage(this);
                    } else {
                        loadImage(this);
                    }
                }
            });
        }

        lazyLoad();

        $(window).on('scroll resize', lazyLoad);

        setTimeout(function () {
            $('.bg_loader').each(function () {
                loadBackgroundImage(this);
            });
            $('.img_loader').each(function () {
                loadImage(this);
            });
        }, 2000);
    });





    /*----------------------------------------------
                SEND POST REQUEST
    ----------------------------------------------*/

    window.__request = function (thisForm, URL) {
        loader1.appendTo('body');

        const formDataSerialized = $(thisForm).serialize();

        if ($(thisForm).find('.errorMsg').length == 0) {
            $(thisForm).prepend('<span class="errorMsg"></span>');
        }

        const config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
        };
        return axios.post(URL, formDataSerialized, config)
            .then(function (response) {
                return response.data;
            })
            .catch(function (error) {
                console.error('Error fetching data:', error); // Debugging line
                alert('Error fetching data. Please try again.'); // User alert
                throw error; // Re-throw the error to propagate it
            })
            .finally(function () {
                // Hide and remove the loader
                loader1.remove();
            });
    }




    /*----------------------------------------------
                SEND GET REQUEST
    ----------------------------------------------*/
    window.sent_request = function (URL, method = 'GET', data = {}) {
        // Append the lang parameter if necessary

        if (shouldAddLangParameter() && URL.indexOf('lang=') === -1) {
            URL += (URL.includes('?') ? '&' : '?') + 'lang=' + lang;
        }

        // Create and show the loader
        loader1.appendTo('body');

        const config = {
            method: method,
            url: URL,
            data: data,
            headers: {
                'X-CSRF-TOKEN': _csrf,
                'X-Requested-With': 'XMLHttpRequest'
            }
        };

        return axios(config)
            .then(function (response) {
                return response.data; // Return the response data
            })
            .catch(function (error) {
                console.error('Error fetching data:', error);
                alert('Error fetching data. Please try again.');
                throw error; // Re-throw the error to propagate it
            })
            .finally(function () {
                // Hide and remove the loader
                setTimeout(() => {
                    loader1.remove();
                }, 200);
            });
    }



    document.addEventListener("click", function (e) {
        const target = e.target.closest(".ci-pagination a");

        if (target) {
            e.preventDefault();
            const pageUrl = target.getAttribute("href");

            loader1.appendTo('body');

            fetch(pageUrl, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, "text/html");

                    // Extract only relevant parts
                    const newContent = doc.querySelector("#mainContent");
                    const newPagination = doc.querySelector(".ci-paginationArea");

                    if (newContent) {
                        document.querySelector("#mainContent").innerHTML = newContent.innerHTML;
                    }
                    if (newPagination) {
                        document.querySelector(".ci-paginationArea").innerHTML = newPagination.innerHTML;
                    }

                    history.pushState({}, "", pageUrl);
                    loader1.remove();
                })
                .catch(err => {
                    console.error(err);
                    loader1.remove();
                });
        }
    });





    $(document).on("keypress keyup blur", ".number", function (event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $(document).on("keypress keyup blur", ".only_number", function (event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });



    window.copyToClipboard = function (element) {
        var url = element.getAttribute("data-url");
        navigator.clipboard.writeText(url).then(() => {
            MSG('success', 'success');
        }).catch(err => {
            console.error("Copy failed:", err);
        });
    }


    window.addLangToUrl = function (url) {
        const lang = appLanguage;
        if (!lang) return url;
        if (url.indexOf('lang=') === -1) {
            if (url.indexOf('?') === -1) {
                return `${url}?lang=${lang}`;
            } else {
                return `${url}&lang=${lang}`;
            }
        }


        return url;
    }


    window.loadAjaxContent__ = function (pageUrl) {
        loader1.appendTo('body');

        fetch(pageUrl, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");

                const newContent = doc.querySelector("#mainContent");
                const newPagination = doc.querySelector(".ci-paginationArea");

                if (newContent && newPagination) {
                    document.querySelector("#mainContent").innerHTML = newContent.innerHTML;
                    document.querySelector(".ci-paginationArea").innerHTML = newPagination.innerHTML;
                    history.pushState({}, "", pageUrl);
                    loader1.remove();
                } else {
                    // Fallback: if no AJAX content found, do full page reload
                    window.location.href = pageUrl;
                }
            })
            .catch(err => {
                console.error("AJAX load error:", err);
                window.location.href = pageUrl; // fallback on fetch error
            });
    }


    window.loadPageContent = function (pageUrl) {

        fetch(pageUrl, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");

                // Extract relevant sections
                const newContent = doc.querySelector("#mainContent");
                const newPagination = doc.querySelector(".ci-paginationArea");

                // Update DOM elements
                if (newContent) {
                    document.querySelector("#mainContent").innerHTML = newContent.innerHTML;
                }

                if (newPagination) {
                    document.querySelector(".ci-paginationArea").innerHTML = newPagination.innerHTML;
                }
            })
            .catch(err => {
                console.error("Error loading page content:", err);
                loader1.remove();
            });
    }




})(jQuery);



(function ($) {
    $.fn.countTo = function (options) {
        const settings = $.extend({
            duration: 1500,
            easing: t => 1 - Math.pow(1 - t, 3) // easeOutCubic
        }, options);

        return this.each(function () {
            const $el = $(this);
            const original = $el.text().trim();

            // Detect prefix/suffix and number part
            const match = original.match(/^([^0-9]*)([0-9,.\-]+)([^0-9]*)$/);
            if (!match) return;

            const prefix = match[1] || "";
            const numStr = match[2].replace(/,/g, "");
            const suffix = match[3] || "";
            const end = parseFloat(numStr);
            const decimals = (numStr.split(".")[1] || "").length;

            const startTime = performance.now();
            const formatter = new Intl.NumberFormat('en-US', {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            });

            function tick(now) {
                const t = Math.min(1, (now - startTime) / settings.duration);
                const val = end * settings.easing(t);
                $el.text(prefix + formatter.format(val) + suffix);
                if (t < 1) requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);
        });
    };
})(jQuery);
