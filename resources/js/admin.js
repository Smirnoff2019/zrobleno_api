$(document).ready(function(){
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    
    function onEvent(event, selector, callback = () => {}) {
        document.addEventListener(event, function(e) {
            if(jQuery(e.target).is(selector)) {
                callback(e.target, e);
            }
        });
    }
    
    function onClick(...args) {
        onEvent('click', ...args);
    }
    
    function onChange(...args) {
        onEvent('change', ...args);
    }

    (($) => {

        const env = {
            base_url: $('meta[name="base_url"]').attr('content'),
            api: {
                images: '/admin/api/gallery/images/modal',
                metaField: '/admin/api/meta-field/generate'
            },
        };

        const app = {
            env: env,
            apiRoute: function(routeName) {
                return this.env.api[routeName];
            },
            galery_curent_url: null,
        };

        app.galery_curent_url = app.apiRoute('images');

        const action = {
            elem: $('.action-box[action]'),
            loading: function(type = 'loading') {
                return $('.action-box[action]').attr('action', type);
            },
            show: function(type = 'show') {
                return $('.action-box[action]').attr('action', type);
            },
            hide: function(type = 'hide') {
                return $('.action-box[action]').attr('action', type);
            },
        };

        function ModalGallery(target, mode = 'single') {
            const modal = $(target);

            const gallery = {
                modal: modal,
                mode: mode,
                gallery: modal.find('#modal-gallery-form'),
                galleryItemName: 'g_image[]',
                curent_url: app.apiRoute('images'),
                actionBox: {
                    elem: modal.find('.action-box[action]'),
                    loading: function(type = 'loading') {
                        return this.elem.attr('action', type);
                    },
                    show: function(type = 'show') {
                        return this.elem.attr('action', type);
                    },
                    hide: function(type = 'hide') {
                        return this.elem.attr('action', type);
                    },
                },
                hooks: {
                    onShow: [],
                    onHide: [],
                    onHidden: [],
                    onSubmit: [],
                },
                
                loadContent: function() {
                    this.actionBox.loading();
                    $.ajax({
                        url: this.curent_url,
                        data: {
                            mode: this.mode
                        },
                        success: (res) => {
                            console.log('res', res)
                            this.gallery.append($(res.data.body));

                            if(res.data.images.next_page_url) {
                                this.curent_url = res.data.images.next_page_url;
                                this.actionBox.show();
                            } else {
                                this.actionBox.hide();
                            }
                        },
                    })
                },
                
                getData: function() {
                    const formData = new FormData(this.gallery[0])
                    const selectedImages = formData.getAll(this.galleryItemName);

                    return mode === 'single' 
                        ? selectedImages[0] 
                        : selectedImages;
                },

                submitBtn: {
                    btn: modal.find('#submit_btn'),
                    disable: function() {
                        return this.btn.attr('disabled', 'disabled');
                    },
                    allow: function() {
                        return this.btn.attr('disabled', null);
                    },
                    counter: function(count) {
                        return this.btn.find('span').text(count);
                    },
                    hideCounter: function() {
                        return this.btn.find('span').hide();
                    },
                    showCounter: function() {
                        return this.btn.find('span').show();
                    },
                },

                onShow: function(callback) {
                    if(typeof callBack == 'function')
                        this.hooks.onShow.push( callBack );   
                },

                onHide: function(callBack) {
                    if(typeof callBack == 'function')
                    this.hooks.onHide.push( callBack );   
                },

                onHidden: function(callBack) {
                    if(typeof callBack == 'function')
                    this.hooks.onHidden.push( callBack );   
                },

                onSubmit: function(callBack) {
                    if(typeof callBack == 'function')
                    this.hooks.onSubmit.push( callBack );   
                },
                
            };

            gallery.modal.find('.list-group a.list-group-item').on('click', function(e) {
                e.preventDefault();

                const btn = $(this);
                const url = btn.attr('href');

                if(btn.hasClass('active')) return;

                (($item) => {
                    $item.removeClass('active');
                    $item.find('.fa-folder-open').addClass('d-none');
                    $item.find('.fa-folder').removeClass('d-none');
                })(btn.closest('.list-group').find('a.list-group-item.active'));
                
                btn.addClass('active');
                btn.find('.fa-folder-open').removeClass('d-none');
                btn.find('.fa-folder').addClass('d-none');

                gallery.curent_url = url;
                gallery.gallery.html(' ');
                gallery.loadContent();
            });

            gallery.submitBtn.btn.on('click', function(...args) {
                gallery.hooks.onSubmit.forEach((callback) => {
                    callback(gallery, gallery.getData(), $(this), ...args);
                });
            });

            gallery.modal
                .on('show.bs.modal', function (...args) {
                    gallery.gallery.html(' ');
                    gallery.loadContent();
                    
                    if(gallery.mode === 'single') {
                        gallery.submitBtn.hideCounter();
                    }

                    gallery.modal.find('#load-more-images-in-modal').on('click', function(event) {
                        gallery.loadContent();
                    })

                    gallery.gallery.on('click', function() {
                        var formData = new FormData(this)
                        const selectedImages = formData.getAll('g_image[]');
                        const imagesCount = selectedImages.length;
            
                        if(imagesCount > 0) {
                            gallery.submitBtn.counter(imagesCount);
                            gallery.submitBtn.allow(imagesCount);
                        } else {
                            gallery.submitBtn.counter(0);
                            gallery.submitBtn.disable(imagesCount);
                        }
                    })

                    gallery.hooks.onShow.forEach((callback) => {
                        callback(gallery, ...args);
                    });
                })
                .on('hide.bs.modal', function (...args) {
                    gallery.hooks.onHide.forEach((callback) => {
                        callback(gallery, gallery.getData(), ...args);
                    });
                })
                .on('hidden.bs.modal', function (...args) {
                    gallery.gallery.html(' ');

                    gallery.hooks.onHidden.forEach((callback) => {
                        callback(gallery, gallery.getData(), ...args);
                    });

                    gallery.submitBtn.btn.off('click')
                    gallery.modal.modal('dispose');
                });

            return gallery;
        }
        window.ModalImagesGallery = ModalGallery;

        function handleImagesGalleryWidgetModal(button) {
            button.on('click', function() {
                const Gallery = ModalGallery($(this).data('target'), $(this).data('mode') || 'single');
                    Gallery.curent_url = app.apiRoute('images');
                const input = $(this).data('input');
                const storage = $(this).parent().find(input);
                const previews = $(this).parent().find(`.preview-images`);
                const mode = $(this).data('mode');
                
                Gallery.onSubmit((gl, data, btn) => {
                    const res = Gallery.getData();
                    if(!res) return previews.removeClass('empty');

                    if(mode === 'single') {
                        previews.html('');
                        const data = JSON.parse(res);
                            
                        storage.val(data.id);
                        previews.removeClass('empty');
                        previews.append($(`<img src="${data.file.url}" data-id="${data.id}" class="img-thumbnail m-1 shadow-sm">`))

                    } else {
                        previews.html('');

                        const data = res.map( (item) => {
                            item = JSON.parse(item);
                            
                            previews.removeClass('empty');
                            previews.append($(`<img src="${item.file.url}" data-id="${item.id}" class="img-thumbnail m-1 shadow-sm">`))

                            return item.id;
                        });

                        storage.val(JSON.stringify(data));
                    }
                });

            });
        }

        (() => {

            handleImagesGalleryWidgetModal( $('button[data-toggle="modal"][data-type="image-gallery"]') );

        })();

        (() => {
            const app = {
                url: '/admin/api/gallery/images',
                curent_url: '/admin/api/gallery/images',
                gallery: $('#images-gallery-cur-page')
            };

            $('#upload-next-gallery-content-btn').on('click', function() {
                const button = $(this);
                const url = button.data('next-page-url');
                button.addClass('d-none');
                button.parent().find('span').removeClass('d-none');
                
                $.ajax({
                    url: url,
                    data: {
                    },
                    success: (res) => {
                        console.log('res', res)
                        app.gallery.append($(res.data.body));
                        console.log('app.gallery', app.gallery)

                        if(res.data.images.next_page_url) {
                            app.curent_url = res.data.images.next_page_url;
                            button.data('next-page-url', res.data.images.next_page_url);
                            button.removeClass('d-none');
                            button.parent().find('span').addClass('d-none');
                        } else {
                            button.parent().find('span').addClass('d-none');
                        }
                    },
                })
            })
        })();

        (() => {
            onChange('#upload-image-form input', (item, e) => {
                $('#upload-image-form').submit();
            });
        })();

        (() => {
            onClick('#input-image-delete-btn', (item, e) => {
                $(item).parent().find('input').val('');
                $(item).parent().find('.preview-images img').attr('src', '');
            });
        })();

        (() => {
            $('#filters-form select').on('change', function(e) {
                $(this).closest('form').submit();
            });
        })();

        (() => {
            $('.tr-pagination').each(function(key) {
                $(this).text(key+1);
            });
        })();

        $('[data-toggle="popover"]').popover();
        
        
        function slugifyInput($input) {
            $input.val( 
                $.slugify($input.val())
            );
        }

        function slugableInput($input) {
            $($input).on('change', function() {
                slugifyInput($input);
            });
        }
        function initSlugable() {
            slugableInput($('input[name="slug"]'));

            $('[data-slugable]').each((key, item) => {
                slugableInput($(item));
            });

            $('.meta-field-card input[data-slugify]').each(function() {
                slugableInput($(this));
            });
            
            $('[data-slugify]').each(function(){
                $(this).slugify($(this).data('slugify'));
            })
        }

        (() => {

            initSlugable();
            
        })();



        // // CKEditor
        (() => {

            // const editorsAreas = $('.ckeditor');
            // console.log('editorsAreas', editorsAreas)

            // editorsAreas.each(function() {
            //     // const id = $(this).attr('id');
            //     // let blogEditor = CKEDITOR.replace( `#${id}` );
            // });

            // if(blogEditor) {
            //     blogEditor.on( 'change', function( evt ) {
            //         let data = evt.editor.getData();
                    // $('.ckeditor').text( data );
            // 	});
            // }

        //     const $client = ClassicEditor
        //         .create( $('.ckeditor').get(0) )
        //         .catch( error => {
        //             console.error( error );
        //         } );

        })();

        // Meta Fields
        (() => {
            const controlSelector = '.meta-field-card-collapse--control';
            const $controls       = $(`#meta-fields-schema ${controlSelector}`);
            const elems           = $(`[data-toggle="change-sync"]`);

            function handleCollapseControl(controller) {
                const $control  = $(controller);
                const $input    = $(controller).find('input[type="checkbox"]');
                const $header   = $control.closest('.meta-field-card-header');
                const $cardName = $header.find('.meta-field-card-header--action');
                const $collapse = $($(controller).data('target'));

                function isActive() {
                    return $header.find(`${controlSelector}`).filter((key, item) => {
                        const result = $(item).attr('aria-expanded') == "true";

                        if(result) {
                            $(item).addClass('text-primary bg-white');
                        } else {
                            $(item).removeClass('text-primary bg-white');
                        }

                        return result;
                    }).get(0) ? true : false;
                }

                function controlCardState() {
                    if(isActive()) {
                        $header.addClass('active');
                        $header.find(`${controlSelector}`).addClass('shadow-sm');
                        $cardName.addClass('text-white').removeClass('text-primary');
                    } else {
                        $header.removeClass('active');
                        $cardName.removeClass('text-white').addClass('text-primary');
                        $header.find(`${controlSelector}`).removeClass('shadow-sm');
                    }
                }

                controlCardState();

                $input.on('change', () => {
                    controlCardState();
                });
                $cardName.on('click', () => {
                    controlCardState();
                });

                $collapse.on('show.bs.collapse', function () {
                    $control.addClass('text-primary bg-white');
                    $header.addClass('active');
                    $cardName.addClass('text-white').removeClass('text-primary');
                    $header.find(`${controlSelector}`).addClass('shadow-sm');
                });

                $collapse.on('hide.bs.collapse', function() {
                    if($control.attr('aria-expanded') != "true") {
                        $control.removeClass('text-primary bg-white');
                    }
                    controlCardState();
                });

                $collapse.on('hidden.bs.collapse', () => {
                    if($control.attr('aria-expanded') != "true") {
                        $control.removeClass('text-primary bg-white');
                    }
                    controlCardState();
                });
            }

            function initCollapseControls($controls) {
                $controls.each(function(){

                    handleCollapseControl(this);
        
                })
            }
            
            function syncChanges(elem, value, target) {
                target = target || elem.data('target');
                value  = value || elem.val();
                
                $(target).text(value);
            }

            function initSyncChanges(elems) {

                elems.on('change', function(e) {
                    syncChanges($(this));
                });

                $('.meta-field-param-field--type').on('change', function() {
                    const trans = {
                        'text'          : 'Текст',
                        'textarea'      : 'Область тексту',
                        'number'        : 'Число',
                        'email'         : 'Email',
                        'url'           : 'Url',
                        'password'      : 'Пароль',
                        'image'         : 'Зображення',
                        'images_gallery': 'Галерея зображень',
                        'wysiwyg'       : 'Візуальний редактор',
                        'select'        : 'Select',
                        'checkbox'      : 'Галочка',
                        'radio'         : 'Radio Button',
                        'true_false'    : 'Так / Ні',
                        'group'         : 'Група',
                    };

                    const type = $(this).val();
                    const value = trans[type];

                    if(value) {
                        syncChanges($(this), value);

                        const id = $(this).closest('.meta-field-card').find('input#_data-field').val();
                        const parent_id = $(this).closest('.meta-field-card').find('input#_data-parent-field').val();

                        const body      = $(this).closest('.meta-field-card-body--params');
                        const header    = $(body.closest('.meta-field-card').find('.meta-field-card-header').get(0));
                        const url       = `${env.base_url}${env.api.metaField}`;

                        const data      = {   
                            id                  : id,
                            parent_id           : parent_id,
                            iteration           : +header.find('.meta-field-card-header--iteration').text(),
                            name                : body.find('.meta-field-param-field--name').val(),
                            slug                : body.find('.meta-field-param-field--slug').val(),
                            type                : type,
                            showParamsFieldsTab : true
                        };
                        console.log('data', data)

                        getMetaFieldByType(data, url, (res, data) => {
                            const card = $(res);

                            $(this).closest('.meta-field-card').replaceWith(card);

                            const $controls = card.find(`${controlSelector}`);
                            const $elems = card.find(`[data-toggle="change-sync"]`);

                            sortableMetaFieldCards(card.find(".sortable"));
                            removeMetaFieldCardHandler(card.find('.meta-field-card--delete'));
                            appendMetaFieldCardHandler(card.find('.add-new-meta-field-card'));
                            initCollapseControls($controls);
                            initSyncChanges($elems);
                            initSlugable();
                        });
                    }

                });
            }
            
            function getMetaFieldByType(data, url, callback = ()=>{}) {
                $.ajax({
                    url: url,
                    data: data,
                    success: (res) => {
                        callback(res, data)
                    },
                });
            };
            
            function removeMetaFieldCardHandler(elem) {
                elem.on('click', function() {
                    const check = confirm('Вы уверены что хотите удалить это мета поле?');
                    if(check) {
                        $(this).closest('.meta-field-card').remove();
                    }
                })
            }

            function appendMetaFieldCardHandler(elem) {
                elem.on('click', function(e) {
                    e.preventDefault();
                    
                    // const url = `${env.base_url}${env.api.metaField}`;
                    const parent_id = $(this).closest('.meta-field-card').find('input#_data-field').val();
                    // const optionsValue = $(this).closest('.meta-field-card').find('.meta-field-param-field').find('[data-param-name="options"]').val();
                    const url = $(this).attr('href');
                    const data   = {   
                        name               : '(not label)',
                        type               : 'text',
                        parent_id          : parent_id,
                        // options            : optionsValue || null,
                        showParamsFieldsTab: true
                    };
                    console.log('data', data)

                    getMetaFieldByType(data, url, (res, data) => {
                        const card = $(res);

                        card.insertBefore($(this).closest('.meta-fields-schema-footer'));

                        const $controls = card.find(`${controlSelector}`);
                        const $elems = card.find(`[data-toggle="change-sync"]`);

                        sortableMetaFieldCards(card.find(".sortable"));
                        removeMetaFieldCardHandler(card.find('.meta-field-card--delete'));
                        appendMetaFieldCardHandler(card.find('.add-new-meta-field-card'));
                        initCollapseControls($controls);
                        initSyncChanges($elems);
                        initSlugable();

                    });
                });
            }

            function sortableMetaFieldCards(elem) {
                elem.sortable({
                    placeholder: "ui-state-highlight list-group-item list-group-item-success my-1 border-top",
                    items: ".meta-field-card, .ui-label-empty",
                    cancel: ".list-group-item:not(.meta-field-card)",
                    handle: ".ui-draggable-control",
                    update: function( event, ui ) {
                        if(ui.sender) {
                            const sender = $(ui.sender);
                            const cards = sender.find(">.meta-field-card");

                            if(cards.length == 0) {
                                sender.find('>.ui-label-empty').first().removeClass('d-none');
                            } else {
                                sender.find('>.ui-label-empty').first().addClass('d-none');
                            }
                        }
                        if(ui.item) {
                            const field = $(ui.item);
                            const cards = field.parent().find(">.meta-field-card");

                            if(cards.length == 0) {
                                field.parent().find('>.ui-label-empty').first().removeClass('d-none');
                            } else {
                                field.parent().find('>.ui-label-empty').first().addClass('d-none');
                            }
                        }
                    },
                    start: function( event, ui ) {
                        $(ui.item).addClass('shadow');
                    },
                    stop: function( event, ui ) {
                        const $card = $(ui.item);
                        const isChild = $card.parent().hasClass('meta-field-children-list');
                        const $inputParentId = $card.find('input#_data-parent-field');

                        $card.removeClass('shadow');

                        if(isChild) {
                            const parentId = $card.parent().data('card');
                            $inputParentId.val(parentId);
                        } else {
                            $inputParentId.val('');
                        }

                    },
                    connectWith: "#meta-fields-schema .sortable",
                    // dropOnEmpty: false,
                });
                // .disableSelection();
            }

            function appendNewFieldHandler($area, data, url) {
                $.ajax({
                    url: url,
                    data: data,
                    success: (res) => {
                        const $field = $(res);
                        const button = $field.find('button[data-toggle="modal"][data-type="image-gallery"]');
                            button.data('target', '#modal-galery-for-meta');

                        handleImagesGalleryWidgetModal( button );

                        $area.append($field);
                    },
                });
            }
            
            sortableMetaFieldCards($("#meta-fields-schema .sortable"));
            removeMetaFieldCardHandler($('.meta-field-card--delete'));
            appendMetaFieldCardHandler($('.add-new-meta-field-card'));
            initCollapseControls($controls);
            initSyncChanges(elems);
            
            onClick('.append-new-contractor-portfolio-image', function(item) {
                const area   = $(item).data('append-area');
                const action = $(item).data('append-action');
                const method = $(item).data('append-method');
                const data   = $(item).data('append-data');
                let $area;

                console.log(data);

                switch (method) {
                    case 'closest':
                        $area = $(item).closest(area);
                        break;
                
                    default:
                        $area = $(area);
                        break;
                }

                appendNewFieldHandler(
                    $area,
                    data,
                    action
                );
            });

            onClick('#append-new-contractor-portfolio', (item) => {
                const $area = $(item).closest('.tab-pane').find('#accordion');
                console.log('$(item)', $(item))
                console.log('$area', $area)
                const url = $(item).data('action');

                $.ajax({
                    url: url,
                    data: {},
                    success: (res) => {
                        const $card = $(res);
                        const button = $card.find('button[data-toggle="modal"][data-type="image-gallery"]');
                            button.data('target', '#modal-galery-for-meta');

                        handleImagesGalleryWidgetModal( button );

                        $area.append($card);
                    },
                });
            });

        })();

        (() => {

            function tableSortable(table) {
                table.sortable({
                    placeholder: "ui-state-highlight my-1",
                    items: "tbody tr",
                    // cancel: ".list-group-item:not(.meta-field-card)",
                    handle: ".ui-draggable-control",
                    update: function( event, ui ) {
                        
                    },
                    start: function( event, ui ) {
                        const item = $(ui.item);
                        const placeholder = $(ui.placeholder);
                        placeholder.height(item.height()+10);
                    },
                    stop: function( event, ui ) {

                    },
                });
                // .disableSelection();
            }

            tableSortable($('.table-sortable'));

            $('.meta-field--images-gallery .delete-image-from-gallery').on('click', function() {
                const result = confirm('Вы уверены что хотите удалить это поле?');
                const gallery = $(this).closest('.meta-field--images-gallery');

                if(result) {
                    const gallery = $(this).closest('.images-gallery-item').remove();
                }

                const items = gallery.find('tbody .images-gallery-item');

                if(items.length == 0) {
                    gallery.find('.images-gallery-empty').removeClass('d-none');
                } else {
                    gallery.find('.images-gallery-empty').addClass('d-none');
                }

            });

            $('.meta-field--images-gallery .append-image-to-gallery').on('click', function(e) {
                e.preventDefault();

                const btn = $(this);
                const url = $(this).attr('href');

                const data = {
                    name: btn.data('name')
                };

                $.ajax({
                    url: url,
                    data: data,
                    success: (res) => {
                        
                        const metaField = $(res);
                        const gallery = btn.closest('.meta-field--images-gallery');

                        gallery.find('tbody').append(metaField);
                        gallery.find('.images-gallery-empty').addClass('d-none');
                        
                        handleImagesGalleryWidgetModal( metaField.find('button[data-toggle="modal"][data-type="image-gallery"]') );
                    },
                });

            });
            

        })();

        (() => {

            const deleteActions = $('.action-cell--delete-record');
            const buttons = deleteActions.find('button');

            buttons.on('click', function(e) {
                e.preventDefault();
                const result = confirm('Ви впевнені, що хочете видали цей запис назавжди?');

                if(result) {
                    $(this).closest('form').submit();
                }
            });

        })();
        (() => {

            $('#edit-image-frame').on('show.bs.modal', function (e) {
                console.log('e', e)
                const btn = $(e.relatedTarget);
                const modal = $(e.currentTarget);

                $.get({
                    url: btn.data('endpoint'),
                    success: (res) => {
                        const data = $(res);
                        const body = modal.find('.modal-body');

                        body.html(data);
                    },
                });

            })

            onClick('#create-new-images-group-btn', (elem, e) => {
                const btn = $(elem);



            })

        })();
        
    })(jQuery);

});
