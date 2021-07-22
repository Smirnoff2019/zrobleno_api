CKEDITOR.plugins.add( 'CastomImage', {
    
    requires: 'widget',

    icons: 'CastomImage',

    init: function( editor ) {

        console.log( 'Editor "' + editor.name + '" is being initialized!' );

        editor.addCommand( 'insertCastomImage', {

            allowedContent: 'img[alt,!src,data-id,data-aling,data-position,data-description]{width,height}(*)',

            exec: function( editor ) {
                $('#modal-gallery-ckeditor-handle-btn').click();
                const Gallery = window.ModalImagesGallery('#modal-gallery-ckeditor')

                const selectedElem = editor['_'].selectionPreviousPath.lastElement.$;
                const $selectedElem = $(selectedElem);
                const aling = $selectedElem.data('aling');
                const position = $selectedElem.data('position');

                function createImage( data ) {

                    const { url, title, id, description, aling, position } = data;
                    const img = editor.document.createElement( 'img' );
                    const alingClass = `aling-${aling}`;
                    // const positionClass = `position-${position}`;
                    const classList = `${alingClass}`;

                    img.setAttribute( 'src', url );
                    img.setAttribute( 'alt', title );
                    img.setAttribute( 'data-id', id );
                    img.setAttribute( 'data-description', description );
                    img.setAttribute( 'data-aling', aling );
                    img.setAttribute( 'data-position', position );
                    img.setAttribute( 'class', classList );
                    img.setAttribute( 'style', "max-width: 100%;" );

                    return img;
                }
                
                Gallery.onSubmit((gl, data, btn) => {
                    const imageData = JSON.parse(data); 
                    console.log('imageData', imageData)
                    editor.insertElement(
                        createImage({
                            id: imageData.id,
                            url: imageData.file.url,
                            title: imageData.file.title,
                            description: imageData.file.description,
                            aling: 'left',
                            position: '',
                        })
                    );
                });
            
            },
		});

        editor.addCommand( 'editCastomImage', {

            allowedContent: 'img[alt,!src,data-id,data-aling,data-position,data-description]{width,height}(*)',

            exec: function( editor ) {

            //     const selectedElem = editor['_'].selectionPreviousPath.lastElement.$;
            //     const $selectedElem = $(selectedElem);

            //     var loadStatus = true;

            //     function createImage( data ) {
            //         loadStatus = false;

            //         const { url, title, id, description, aling, position, width, height } = data;
                   
            //         const img = editor.document.createElement( 'img' );
            //         const alingClass = `aling-${aling}`;
            //         const positionClass = `position-${position}`;
            //         const classList = `${alingClass} ${positionClass}`;

            //         img.setAttribute( 'src', url );
            //         img.setAttribute( 'alt', title );
            //         img.setAttribute( 'data-id', id );
            //         img.setAttribute( 'data-title', title );
            //         img.setAttribute( 'data-description', description );
            //         img.setAttribute( 'data-aling', aling );
            //         img.setAttribute( 'data-position', position );
            //         img.setAttribute( 'class', classList );
            //         img.setAttribute( 'width', width );
            //         img.setAttribute( 'height', height );

            //         setTimeout(() => {
            //             loadStatus = true;
            //         }, 200);

            //         return img;
            //     }

            //     const aling = $selectedElem.data('aling');
            //     const position = $selectedElem.data('position')
            //     const id = $selectedElem.data('id');
            //     const width = $selectedElem.prop('width')
            //     const height = $selectedElem.prop('height')
            //     const url = $selectedElem.prop('src')
            //     const description = $selectedElem.data('description')
            //     const title = $selectedElem.data('title')

            //     $({}).ImageLibraryAttachmentEditor(( request ) => {
            //         if(loadStatus) {
            //             editor.insertElement( createImage( request ) );
            //         }
            //     }, {
            //         showForm: true,
            //         aling: true,
            //         alingValue: aling,
            //         position: true,
            //         positionValue: position,
            //         size: true,
            //     }, {
            //         id: id,
            //         url: url,
            //         width: width,
            //         height: height,
            //         alingValue: aling,
            //         positionValue: position
            //     });
               
            },
        });

        editor.ui.addButton( 'CastomImage', {
            label: 'Загрузить или выбрать изображение из медиатеки',
            command: 'insertCastomImage',
            toolbar: 'insert'
        });

        CKEDITOR.dialog.add( 'CastomImageDialog', this.path + 'dialogs/CastomImage.js' );

        if ( editor.contextMenu ) {
            editor.addMenuGroup( 'CastomImageGroup' );
            // editor.addMenuItem( 'CastomImageItem', {
            //     label: 'Редактировать',
            //     icon: this.path + 'icons/CastomImage.png',
            //     command: 'editCastomImage',
            //     group: 'CastomImageGroup'
            // });

            editor.contextMenu.addListener( function( element ) {
                if( element.getAscendant( 'img', true ) ) {
                    return { CastomImageItem: CKEDITOR.TRISTATE_OFF };
                }
            });
        }
        
    },
});