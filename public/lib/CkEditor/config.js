var selectorId = "";
var editorCK;
var ckText=""

class MyUploadAdapter {
    constructor(loader, editor) {
        this.loader = loader;
        this.temporaryImageUrl = null;
        this.editor = editor;
    }

    upload() {
        return this.loader.file.then(file => new Promise((resolve, reject) => {
            this._initRequest();
            this._initListeners(resolve, reject, file);
            this._sendRequest(file, resolve, reject);
        }));
    }

    abort() {
        if (this.xhr) {
            this.xhr.abort();
        }
    }

    _initRequest() {
        this.xhr = new XMLHttpRequest();
        this.xhr.open('POST', '/upload-images', true);
        this.xhr.responseType = 'json';
    }

    _initListeners(resolve, reject, file) {
        const {xhr, loader} = this;
        const genericErrorText = `Couldn't upload file: ${file.name}.`;

        xhr.addEventListener('error', () => reject(genericErrorText));
        xhr.addEventListener('abort', () => reject());
        xhr.addEventListener('load', () => {
            const response = xhr.response;

            if (!response || response.error) {
                return reject(response && response.error ? response.error.message : genericErrorText);
            }

            resolve({
                default: response.url
            });
        });

        if (xhr.upload) {
            xhr.upload.addEventListener('progress', evt => {
                if (evt.lengthComputable) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            });
        }
    }

    _sendRequest(file) {
        return new Promise((resolve, reject) => {

            const data = new FormData();
            data.append('upload', file)
            const self = this;

            this.xhr.addEventListener('load', function () {
                const response = self.xhr.response;
                if (!response || response.error) {
                    return reject(response && response.error ? response.error.message : genericErrorText);
                }

                const imageUrl = response.urls[0];
                const altText = prompt("Please enter alt text for the image:", "Alt text");

                if (!self.editor) {
                    console.error("Editor instance not available.");
                    return;
                }

                const selection = self.editor.model.document.selection;

                const imageElement = document.createElement('img');
                imageElement.src = imageUrl;
                imageElement.alt = altText || "";


                self.editor.setData(`${self.editor.getData()}<img src="${imageUrl}" alt="${altText}" title="${altText}"> `);
                resolve({
                    default: imageUrl
                });
            });

            this.xhr.addEventListener('error', function () {
                console.error("Error during upload.");
            });

            this.xhr.addEventListener('abort', function () {
                console.error("Upload aborted.");
            });
            this.xhr.send(data);
        });
    }
}

function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = loader => new MyUploadAdapter(loader, editor);
}

function stripInlineStyles(html) {
    const doc = new DOMParser().parseFromString(html, 'text/html');

    doc.querySelectorAll('*').forEach(element => {
        element.removeAttribute('style');
    });

    return doc.body.innerHTML;
}

function configureCKEditor(selector, vueInstance, initialData) {
    CKEDITOR.ClassicEditor.create(document.querySelector(selector), {
        dropdownParent: '#add',
        forcePasteAsPlainText: true,
        pasteFromWordRemoveStyles: true,
        AutoDetectPasteFromWord: true,
        forcePasteAsPlainText: true,
        copyFormatting: true,
        allowedContexts: false,
        ui: {
            viewportOffset: {
                top: 100
            }
        },
        config: {
            pasteFilter: 'plain-text'
        },
        toolbar: {

            items: [
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true,
        },

        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        heading: {
            options: [
                {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'},
                {model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4'},
                {model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5'},
                {model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6'}
            ]
        },

        placeholder: 'Hãy viết gì đó!',

        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif',
                'Open Sans, sans-serif'
            ],
            supportAllValues: true,

        },

        fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
        },
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: false,
                    classes: false,
                    styles: false
                }
            ]
        },
        htmlEmbed: {
            showPreviews: true
        },

        link: {
            decorators: {
                addTargetToExternalLinks: true,
                addTargetToInternalLinks: true,
                addNoopener: true,
                addNoreferrer: true,
                addTargetToPhoneLinks: true,
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                },
                openInNewTab: {
                    mode: 'manual',
                    label: 'Open in new tab',
                    attributes: {
                        target: '_blank',
                        rel: 'noopener noreferrer'
                    }
                }
            }
        },

        removePlugins: [

            'CKBox',
            'CKFinder',
            'EasyImage',

            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',

            'MathType',
            'Link',

            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
            'PasteFromOfficeEnhanced',
            'autogrow'
        ],
        extraPlugins: [MyCustomUploadAdapterPlugin],
        mediaEmbed: {
            previewsInData: true
        },


    }).then(editor => {
        editor.plugins.get('FileRepository').createUploadAdapter = loader => new MyUploadAdapter(loader, editor);
        editorCK = editor;
        editor.setData(initialData);
        editor.model.document.on('change:data', () => {

            console.log("selector: ", selector)
            vueInstance.ckText = editor.getData();
        });

        editor.editing.view.document.on('paste', (evt, data) => {
            evt.stop();
            let lastContent = editor.getData()
            var divContentContainer = document.createElement('div');
            divContentContainer.innerHTML = data.dataTransfer.getData('text/html');
            var elementTableComponents = divContentContainer.querySelectorAll('table,td,th'), i;
            for (i = 0; i < elementTableComponents.length; ++i) {
                elementTableComponents[i].style = '';
            }
            var elementComponents = divContentContainer.querySelectorAll('p,span,a,h2,h3,h4,h5,h6,table,td,th,ul,ol,li'),
                i;
            for (i = 0; i < elementComponents.length; ++i) {
                elementComponents[i].style.color = '';
            }
            var elementAnchorComponents = divContentContainer.querySelectorAll('a'), i;
            for (i = 0; i < elementAnchorComponents.length; ++i) {
                if (!$(elementAnchorComponents[i]).attr('href')) {
                    $(elementAnchorComponents[i]).contents().unwrap();
                }
            }

            editor.setData(lastContent + divContentContainer.innerHTML)

        });
    })

}
