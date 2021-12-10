<template>
    <div>
        <input
            v-if="styleCKFinder == 'popup' || styleCKFinder == 'modal'"
            type="hidden"
            :id="id"
            class="input"
            :value="value"
        />
        <div
            v-if="styleCKFinder == 'widget'"
            :id="id"
        ></div>
    </div>
</template>

<script>
export default {
    props: {
        id: {
            type: String,
            default: 'ckfinderUpload'
        },
        value: {
            type: String,
            default: ''
        },
        width: {
            type: String,
            default: "1000"
        },
        height: {
            type: String,
            default: "800"
        },
        multiImage: {
            type: Boolean,
            default: false
        },
        lang: {
            type: String,
            default: 'vi'
        },
        readonly: {
            type: Boolean,
            default: false
        },
        thumbSize: {
            type: Number,
            default: 150
        },
        styleCKFinder: {
            type: String,
            default: ''
        },
        displayFoldersPanel: {
            type: Boolean,
            default: true
        },
        readOnlyExclude: {
            type: String,
            default: ''
        },
        type: {
            type: String,
            default: ''
        }
    },
    data() {
        return {

        }
    },
    methods: {
        selectFileWithCKFinder(id,style) {
            let vm = this;
            let output = document.getElementById(id);
            let chosenFile = "";
            let value = "";
            switch (style) {
                case 'modal':
                    CKFinder.modal({
                        thumbnailDefaultSize: vm.thumbSize,
                        readOnly: vm.readonly,
                        language: vm.lang,
                        chooseFiles: true,
                        displayFoldersPanel: vm.displayFoldersPanel,
                        readOnlyExclude: vm.readOnlyExclude,
                        width: vm.width,
                        height: vm.height,
                        onInit: function( finder ) {
                            finder.on( 'files:choose', function( evt ) {
                                let file = evt.data.files;
                                if(vm.multiImage == false){
                                    value = file.first().getUrl();
                                }else{
                                    chosenFile = "";
                                    file.forEach(function(file, i){
                                        chosenFile += " " + file.getUrl();
                                    });
                                    let arrUrl = chosenFile.split(" ");
                                    let arr = arrUrl.filter(function (el) {
                                        return el != "";
                                    });
                                    value = arr;
                                }
                                if(vm.type == 'files'){
                                    let arr = file.models.map(r => {
                                        return {
                                            size: r['attributes'].size,
                                            name: r['changed'].url
                                        }
                                    });
                                    vm.$emit('inputCKFinder', arr);
                                }else{
                                    vm.$emit('inputCKFinder',value)
                                }
                            });
                            finder.on( 'file:choose:resizedImage', function( evt ) {
                                value = evt.data.resizedUrl;
                                if(vm.type == 'files'){
                                    let arr = file.models.map(r => {
                                        return {
                                            size: r['attributes'].size,
                                            name: r['changed'].url
                                        }
                                    });
                                    vm.$emit('inputCKFinder', arr);
                                }else{
                                    vm.$emit('inputCKFinder',value)
                                }
                            });
                        }
                    });
                    break;
                case 'popup':
                    CKFinder.popup({
                        thumbnailDefaultSize: vm.thumbSize,
                        readOnly: vm.readonly,
                        language: vm.lang,
                        chooseFiles: true,
                        displayFoldersPanel: vm.displayFoldersPanel,
                        readOnlyExclude: vm.readOnlyExclude,
                        width: vm.width,
                        height: vm.height,
                        onInit: function( finder ) {
                            finder.on( 'files:choose', function( evt ) {
                                let file = evt.data.files;
                                if(vm.multiImage == false){
                                    value = file.first().getUrl();
                                }else{
                                    chosenFile = "";
                                    file.forEach(function(file, i){
                                        chosenFile += " " + file.getUrl();
                                    });
                                    let arrUrl = chosenFile.split(" ");
                                    let arr = arrUrl.filter(function (el) {
                                        return el != "";
                                    });
                                    value = arr;
                                }
                                vm.$emit('inputCKFinder',value)
                            });
                            finder.on( 'file:choose:resizedImage', function( evt ) {
                                value = evt.data.resizedUrl;
                                vm.$emit('inputCKFinder',value)
                            });
                        }
                    });
                    break;
                default:
                    CKFinder.modal({
                        thumbnailDefaultSize: vm.thumbSize,
                        readOnly: vm.readonly,
                        language: vm.lang,
                        chooseFiles: true,
                        displayFoldersPanel: vm.displayFoldersPanel,
                        readOnlyExclude: vm.readOnlyExclude,
                        width: vm.width,
                        height: vm.height,
                        onInit: function( finder ) {
                            finder.on( 'files:choose', function( evt ) {
                                let file = evt.data.files;
                                if(vm.multiImage == false){
                                    value = file.first().getUrl();
                                }else{
                                    chosenFile = "";
                                    file.forEach(function(file, i){
                                        chosenFile += " " + file.getUrl();
                                    });
                                    let arrUrl = chosenFile.split(" ");
                                    let arr = arrUrl.filter(function (el) {
                                        return el != "";
                                    });
                                    value = arr;
                                }
                                vm.$emit('inputCKFinder',value)
                            });
                            finder.on( 'file:choose:resizedImage', function( evt ) {
                                value = evt.data.resizedUrl;
                                vm.$emit('inputCKFinder',value)
                            });
                        }
                    });
                    break;
            }
        }
    },
    mounted() {
        let vm = this;
        switch (vm.styleCKFinder) {
            case 'widget':
                CKFinder.widget( `${vm.id}` , {
                    thumbnailDefaultSize: vm.thumbSize,
                    readOnly: vm.readonly,
                    language: vm.lang,
                    chooseFiles: true,
                    displayFoldersPanel: vm.displayFoldersPanel,
                    readOnlyExclude: vm.readOnlyExclude,
                    width: vm.width,
                    height: vm.height,
                });
                break;
            case 'fullpage':
                CKFinder.start();
                break;
            default:
                break;
        }
    },
    created() {
        localStorage.removeItem("ckf.settings");
    },
}
</script>

<style>

</style>
